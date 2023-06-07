@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <div class="dt-buttons btn-group flex-wrap">
                            <a class="btn btn-success buttons-create buttons-html5" type="button"
                               href="{{ route('time_sheet.create') }}">
                                <span>Create New</span>
                            </a>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ADMIN)
                            <div class="dt-buttons btn-group flex-wrap">
                                <a class="btn btn-secondary buttons-excel buttons-html5"
                                   href="{{ route('time_sheet.export') }}"
                                   aria-controls="example1" type="button"><span>Export</span></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                               aria-describedby="example1_info">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Work Day</th>
                                <th>Difficult</th>
                                <th>Plan</th>
                                <th>Created by</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timeSheets as $timeSheet)
                                <tr>
                                    <td>{{ $timeSheet->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($timeSheet->work_day)->format('Y-m-d') }}</td>
                                    <td>{!! $timeSheet->difficult !!}</td>
                                    <td>{!! $timeSheet->plan !!}</td>
                                    <td>{!! $timeSheet->user->name !!}</td>
                                    <td>{!! $timeSheet->manager->name !!}</td>
                                    <td>{{ \App\Models\TimeSheet::STATUS[$timeSheet->status] }}</td>
                                    <td class="d-flex center">
                                        <a href="{{ route('time_sheet.edit', $timeSheet->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12s">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
