<?php

namespace App\Repositories;

use App\Models\TimeSheet;
use App\Models\TimeSheetDetail;
use App\Models\User;
use App\Repositories\Interfaces\ITimeSheetRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeSheetRepository extends BaseRepository implements ITimeSheetRepository
{
    public function __construct(TimeSheet $model)
    {
        $this->model = $model;
    }

    /**
     * Get list User
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        $query = $this->model->with(['user', 'manager']);
        if (User::MANAGER == Auth::user()->role) {
            $query->where('created_by', Auth::id())->where('manager_id', Auth::id());
        } else if (Auth::user()->role == User::USER) {
            $query->where('created_by', Auth::id());
        }

        return $query->paginate(15);
    }

    /**
     * Create timesheet
     *
     * @param array $attributes
     * @return array
     */
    public function store(array $attributes)
    {
        try {
            DB::beginTransaction();
            $now = Carbon::now();
            $timeSheet = TimeSheet::create([
                'work_day' => $attributes['work_day'],
                'difficult' => $attributes['difficult'],
                'plan' => $attributes['plan'],
                'created_by' => Auth::id(),
                'manager_id' => $attributes['manager_id'],
                'is_overdue' => Carbon::parse($attributes['work_day'])->format('Y-m-d') < $now->format('Y-m-d'),
            ]);

            if ($timeSheet) {
                $timeSheetDetails = $convertData = [];
                for ($i = 0; $i < count($attributes['task_ids']); $i++) {
                    $convertData['time_sheet_id'] = $timeSheet->id;
                    $convertData['task_id'] = $attributes['task_ids'][$i];
                    $convertData['task_content'] = $attributes['task_contents'][$i];
                    $convertData['work_time'] = $attributes['work_times'][$i];
                    $timeSheetDetails[] = $convertData;
                }

                if (TimeSheetDetail::insert($timeSheetDetails)) {
                    DB::commit();
                    return [
                        'error' => false,
                        'message' => __('message.Create success')

                    ];
                }
            }
        } catch (\Exception $exception) {
            DB::rollback();
            return [
                'error' => true,
                'message' => $exception->getMessage()

            ];
        }
    }

    public function update(array $attributes)
    {
        try {
            DB::beginTransaction();
            $timeSheet = TimeSheet::query()->find($attributes['id']);
            $newWorkDay = Carbon::parse($attributes['work_day'])->format('Y-m-d');
            $oldWorkDay = Carbon::parse($timeSheet->work_day)->format('Y-m-d');
                $timeSheet->update([
                    'work_day' => $attributes['work_day'],
                    'difficult' => $attributes['difficult'],
                    'plan' => $attributes['plan'],
                    'created_by' => Auth::id(),
                    'manager_id' => $attributes['manager_id'],
                    'is_overdue' => $newWorkDay < $oldWorkDay,
                ]);

            if ($timeSheet) {
                TimeSheetDetail::query()->where('time_sheet_id', $timeSheet->id)->delete();
                $timeSheetDetails = $convertData = [];
                for ($i = 0; $i < count($attributes['task_ids']); $i++) {
                    $convertData['time_sheet_id'] = $timeSheet->id;
                    $convertData['task_id'] = $attributes['task_ids'][$i];
                    $convertData['task_content'] = $attributes['task_contents'][$i];
                    $convertData['work_time'] = $attributes['work_times'][$i];
                    $timeSheetDetails[] = $convertData;
                }

                if (TimeSheetDetail::insert($timeSheetDetails)) {
                    DB::commit();

                    return [
                        'error' => false,
                        'message' => __('message.Update success')

                    ];
                }
            }
        } catch (\Exception $exception) {
            DB::rollback();

            return [
                'error' => false,
                'message' => $exception->getMessage()

            ];
        }
    }

    /**
     * Create response time sheet calendar
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function calendar()
    {
        $query = $this->model->with(['user', 'manager']);
        if (User::MANAGER == Auth::user()->role) {
            $query->where('created_by', Auth::id())->where('manager_id', Auth::id());
        } else if (Auth::user()->role == User::USER) {
            $query->where('created_by', Auth::id());
        }

        return $query->get();
    }

}
