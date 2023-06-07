<?php

namespace App\Http\Controllers;

use App\Exports\TimeSheetExport;
use App\Http\Requests\TimeSheetRequest;
use App\Models\TimeSheet;
use App\Models\User;
use App\Repositories\Interfaces\ITaskRepository;
use App\Repositories\Interfaces\ITimeSheetRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TimeSheetController extends Controller
{
    protected $userRepository, $timesheetRepository, $taskRepository;

    public function __construct(IUserRepository $userRepository, ITimeSheetRepository $timesheetRepository,
                                ITaskRepository $taskRepository
    ) {
        $this->userRepository = $userRepository;
        $this->timesheetRepository = $timesheetRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timeSheets = $this->timesheetRepository->list();
        return view('timesheet.list', compact('timeSheets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = $this->taskRepository->all();
        $managers = $this->userRepository->getUserByRole(User::MANAGER);
        return view('timesheet.create', compact('tasks', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeSheetRequest $request)
    {
        $createTimeSheet = $this->timesheetRepository->store($request->all());
        if ($createTimeSheet['error']) {
            return redirect()->route('time_sheet.index')->with('success', $createTimeSheet['message']);
        }

        return back()->withError($createTimeSheet['message'])->withInput();

    }

    /**
     * Display the specified resource.
     */
    public function calendar()
    {
        $timeSheets = $this->timesheetRepository->calendar();
        return view('timesheet.calendar', compact('timeSheets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timeSheet = $this->timesheetRepository->with('timeSheetDetails')->getById($id);
        $this->authorize('update', $timeSheet);
        $tasks = $this->taskRepository->all();
        $managers = $this->userRepository->getUserByRole(User::MANAGER);

        return view('timesheet.edit', compact('tasks', 'managers', 'timeSheet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeSheetRequest $request)
    {
        $userUpdate = $this->timesheetRepository->update($request->all());
        if (!$userUpdate['error']) {
            return redirect()->route('time_sheet.index')->with('success', $userUpdate['message']);
        }

        return redirect()->back()->withErrors( $userUpdate['message']);
    }

    /**
     * Export timesheet.
     */
    public function export()
    {
        if (Auth::user()->role != User::ADMIN) {
            abort(403);
        }
        return Excel::download(new TimeSheetExport(), 'time_sheet.xlsx');
    }
}
