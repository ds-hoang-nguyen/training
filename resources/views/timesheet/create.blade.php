@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">TimeSheet Create</h3>
            </div>
            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <form action="{{ route('time_sheet.store') }}" id="time_sheet_create" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group col-3">
                        <label for="exampleInputEmail1">Work day</label>
                        <input type="date" name="work_day" class="form-control work_day">
                        @error('work_day')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row time_sheet_detail">
                        <div class="col-md-10 form_task row">
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Task</label>
                                <select name="task_ids[]" class="form-control">
                                    <option value="">----</option>
                                    @foreach($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Task Content</label>
                                <input type="text" name="task_contents[]" class="form-control task_contents"
                                       placeholder="Task Content">
                                @error('task_contents')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Work time</label>
                                <input type="text" name="work_times[]" class="form-control work_times" placeholder="Work time">
                                @error('task_contents')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 30px">
                            <button type="button" class="btn btn-primary new_form_task">Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="difficult">Manager</label>
                        <select name="manager_id" class="form-control">
                            <option value="">----</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                        @error('manager_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="difficult">Difficult</label>
                        <textarea class="form-control" name="difficult" id="difficult" cols="200" rows="5"></textarea>
                        @error('difficult')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="plan">Plan</label>
                        <textarea class="form-control" id="plan" name="plan" cols="200" rows="5"></textarea>
                        @error('plan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary save_time_sheet">Submit</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/time_sheet.js') }}"></script>
    @endpush
@endsection
