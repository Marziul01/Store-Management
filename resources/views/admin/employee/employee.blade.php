@extends('admin.master')

@section('title')
    Employees
@endsection

@section('content')

    <div class="container-fluid">
        @include('admin.auth.message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="alert-ul">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#AddEmployeesModal">
                <i class="bi bi-file-earmark-plus"></i> Add New</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($employees->isNotEmpty())
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>  {{ $employee->employeePosition->positions }} {{ isset($employee->employeePosition->sub_positions) ? '>'. $employee->employeePosition->sub_positions : '' }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>
                                    @if($employee->status == 1)
                                        <i class="bi bi-check-circle-fill" style="color: deepskyblue"></i> ACTIVE
                                    @else
                                        <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                    @endif
                                </td>
                                <td class="table-action-td d-flex align-items-center column-gap-3">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditemployeeModal_{{ $employee->id }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#EditViewemployeeModal_{{ $employee->id }}"><i class="bi bi-pen-fill"></i> View</a>
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Employee Details?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"> No Employees Found !!! </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>




{{--    Add Category Model--}}

    <div class="modal fade" id="AddEmployeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Employee
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee Position</label>
                            <select class="form-control" name="employee_positions_id">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->positions }} {{ isset($position->sub_positions) ? '>'.$position->sub_positions : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="slug" name="name" placeholder="Employee Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" id="slug" name="email" placeholder="Employee Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control" id="slug" name="phone" placeholder="Employee Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" id="slug" name="address" placeholder="Employee Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Salary</label>
                            <input type="number" class="form-control" id="slug" name="salary" placeholder="Employee Salary">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--    Edit Category Model--}}
    @if(isset($employee))
        @foreach($employees as $employee)
            <div class="modal fade" id="EditemployeeModal_{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Edit Employee Details
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee Position</label>
                                    <select class="form-control" name="employee_positions_id">
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" {{ $employee->employee_positions_id == $position->id ? 'selected' : '' }}>
                                                {{ $position->positions }} {{ isset($position->sub_positions) ? '>'.$position->sub_positions : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="slug" name="name" value="{{ $employee->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" id="slug" name="email" value="{{ $employee->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" class="form-control" id="slug" name="phone" value="{{ $employee->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" id="slug" name="address" value="{{ $employee->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Salary</label>
                                    <input type="number" class="form-control" id="slug" name="salary" value="{{ $employee->salary }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <p class="py-2">Previous Image: </p>
                                    <img src="{{ asset($employee->image) }}" width="100px" height="100px">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee Status</label>
                                    <select class="form-control" name="employee_positions_id">
                                            <option value="1" {{ $employee->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ $employee->status == 2 ? 'selected' : '' }}>Inactive</option>
                                            <option value="3" {{ $employee->status == 3 ? 'selected' : '' }}>Fired</option>
                                            <option value="4" {{ $employee->status == 4 ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    {{--   View Model--}}
    @if(isset($employee))
        @foreach($employees as $employee)
            <div class="modal fade" id="EditViewemployeeModal_{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="btn  {{ $employee->status == 1 ? 'btn-success' : 'btn-danger'}}"> {{ $employee->status == 1 ? 'Active' : 'Inactive'}} </a>
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column justify-content-center align-items-center border-bottom-1">
                                <img src="{{ asset($employee->image) }}" height="200px" class="mb-2">
                                <h5 class="text-center">{{ $employee->name }}</h5>
                            </div>
                            <div class="row px-3" >
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Email: {{ $employee->email }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Phone: {{ $employee->phone }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Address: {{ $employee->address}}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Salary: {{ $employee->salary}}</p>
                                </div>

                            </div>
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




