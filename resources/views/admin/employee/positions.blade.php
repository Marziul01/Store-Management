@extends('admin.master')

@section('title')
    Employee Positions
@endsection

@section('content')

    <div class="container-fluid">
        @include('admin.auth.message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="alert-ul">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Page Heading -->

        <div class="card mt-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="pl-2 pt-2">Employee Positions</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#AddemployeePositionModal">
                    <i class="bi bi-file-earmark-plus"></i> Add New Employee Position
                </a>
            </div>
            <div class="card-body pt-0">
                <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Employee Position</th>
                            <th>Employees</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($employeePositions->isNotEmpty())
                        @foreach($employeePositions->whereNull('sub_positions') as $employeePosition)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeePosition->positions }}</td>
                                <td>{{ $employeePosition->total_members }}</td>
                                <td>
                                    @if($employeePosition->status == 1)
                                        <i class="bi bi-check-circle-fill" style="color: rgb(21, 255, 0)"></i> ACTIVE
                                    @else
                                        <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                    @endif
                                </td>
                                <td class="table-action-td d-flex align-items-center column-gap-3">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditemployeePositionModal_{{ $employeePosition->id }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                    @if($employeePosition->status == 1)
                                        <a class="btn btn-sm btn-warning" href="{{ route('employeePosition.show', $employeePosition->id) }}"><i class="bi bi-x-circle-fill"></i> Inactive</a>
                                    @else
                                        <a class="btn btn-sm btn-success" href="{{ route('employeePosition.show', $employeePosition->id) }}"><i class="bi bi-check-circle-fill"></i> Active</a>
                                    @endif

                                    <form action="{{ route('employeePosition.destroy', $employeePosition->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Employee Position?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"> No Employee Position Found !!! </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="pl-2 pt-2">Employee Sub Positions</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#AddemployeeSubPositionModal">
                    <i class="bi bi-file-earmark-plus"></i> Add New Sub Employee Position
                </a>
            </div>
            <div class="card-body pt-0">
                <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Employee Position</th>
                            <th>Sub Employee Position</th>
                            <th>Employees</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($employeePositions->isNotEmpty())
                        @foreach($employeePositions->whereNotNull('sub_positions') as $employeePosition)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeePosition->positions }}</td>
                                <td>{{ $employeePosition->sub_positions }}</td>
                                <td>{{ $employeePosition->total_members }}</td>
                                <td>
                                    @if($employeePosition->status == 1)
                                        <i class="bi bi-check-circle-fill" style="color: rgb(9, 255, 0)"></i> ACTIVE
                                    @else
                                        <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                    @endif
                                </td>
                                <td class="table-action-td d-flex align-items-center column-gap-3">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditemployeeSubPositionModal_{{ $employeePosition->id }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                    @if($employeePosition->status == 1)
                                        <a class="btn btn-sm btn-warning" href="{{ route('employeePosition.show', $employeePosition->id) }}"><i class="bi bi-x-circle-fill"></i> Inactive</a>
                                    @else
                                        <a class="btn btn-sm btn-success" href="{{ route('employeePosition.show', $employeePosition->id) }}"><i class="bi bi-check-circle-fill"></i> Active</a>
                                    @endif

                                    <form action="{{ route('employeePosition.destroy', $employeePosition->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Employee Sub Position?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"> No Employee Sub Position Found !!! </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


{{--    Add Category Model--}}

    <div class="modal fade" id="AddemployeePositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Employee Position
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employeePosition.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee Position</label>
                            <input type="text" class="form-control" id="name" name="positions">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--    Add Sub Employeee Model--}}
    <div class="modal fade" id="AddemployeeSubPositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Employee Sub Position
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employeePosition.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Head Employee Position</label>
                            <select class="form-control" name="positions">
                                @foreach ($employeePositions->whereNull('sub_positions') as $employees)
                                    <option value="{{ $employees->positions }}">{{ $employees->positions }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee Sub Position</label>
                            <input type="text" class="form-control" id="name" name="sub_positions">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--    Edit employeePosition Model--}}
    @if(isset($employeePosition))
        @foreach($employeePositions as $employeePosition)
            <div class="modal fade" id="EditemployeePositionModal_{{ $employeePosition->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Edit Employee Position
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employeePosition.update', $employeePosition->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee Position</label>
                                    <input type="text" class="form-control" name="positions" value="{{ $employeePosition->positions }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(isset($employeePosition))
        @foreach($employeePositions as $employeePosition)
            <div class="modal fade" id="EditemployeeSubPositionModal_{{ $employeePosition->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Edit Employee Position
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employeePosition.update', $employeePosition->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Head Employee Position</label>
                                    <select class="form-control" name="positions">
                                        @foreach ($employeePositions->whereNull('sub_positions') as $employees)
                                            <option value="{{ $employees->positions }}" {{ $employeePosition->positions == $employees->positions ? 'selected' : '' }}>{{ $employees->positions }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Employee Position</label>
                                    <input type="text" class="form-control" name="sub_positions" value="{{ $employeePosition->sub_positions }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('customJs')
    <script src="{{ asset('admin-assets') }}/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin-assets') }}/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-assets') }}/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection




