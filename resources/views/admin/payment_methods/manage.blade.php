@extends('admin.master')

@section('title')
    Payment Methods
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
            <h1 class="h3 mb-0 text-gray-800">Payment Methods</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#AddPaymentModal">
                <i class="bi bi-file-earmark-plus"></i> Add New</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Payment Method</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($payments->isNotEmpty())
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset( $payment->image ) }}" width="50px" height="50px"></td>
                                <td>{{ $payment->payment_type }}</td>
                                <td>{{ $payment->charge }}</td>
                                <td>
                                    @if($payment->status == 1)
                                        <i class="bi bi-check-circle-fill" style="color: deepskyblue"></i> ACTIVE
                                    @else
                                        <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                    @endif
                                </td>
                                <td class="table-action-td d-flex align-items-center column-gap-3">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditpaymentModal_{{ $payment->id }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                    @if($payment->status == 1)
                                        <a class="btn btn-sm btn-warning" href="{{ route('payment.show', $payment->id) }}"><i class="bi bi-x-circle-fill"></i> Inactive</a>
                                    @else
                                        <a class="btn btn-sm btn-success" href="{{ route('payment.show', $payment->id) }}"><i class="bi bi-check-circle-fill"></i> Active</a>
                                    @endif

                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Payment Method?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"> No Payment Methods Found !!! </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $payments->links() }}
            </div>
        </div>

    </div>




{{--    Add Category Model--}}

    <div class="modal fade" id="AddPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Payment Method
                </div>
                <div class="modal-body">
                    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Payment Method</label>
                            <input type="text" class="form-control" name="payment_type">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Payment Charge Amount</label>
                            <input type="text" class="form-control" name="charge">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--    Edit Category Model--}}
    @if(isset($payment))
        @foreach($payments as $payment)
            <div class="modal fade" id="EditpaymentModal_{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Edit Payment Methods
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Payment Method Name</label>
                                    <input type="text" class="form-control" name="payment_type" value="{{ $payment->payment_type }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Payment Charge Amount</label>
                                    <input type="text" class="form-control" name="charge" value="{{ $payment->charge }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <p class="py-2">Previous Image: </p>
                                    <img src="{{ asset($payment->image) }}" width="100px" height="100px">
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




