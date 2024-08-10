@extends('admin.master')

@section('title')
    Order Details
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
            <h1 class="h3 mb-0 text-gray-800">Order Details</h1>
        </div>

        <section class="py-2 row mobile-section">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12 card">
                        <div class="card-header mobile-overflow-x">
                            <div>
                                <h6>Order Number:</h6>
                                <h5 class="mt-2">{{ $order->order_number }}</h5>
                            </div>
                            <div>
                                <h6>Order Date:</h6>
                                <h5 class="mt-2">{{ $order->created_at->format('Y-m-d') }}</h5>
                            </div>
                            <div>
                                <h6>Order Status:</h6>
                                <h5 class="mt-3">
                                    @if($order->status == 1)
                                        Processing
                                    @elseif($order->status == 2)
                                        Cancelled
                                        <br>
                                        <span class="text-danger font-sm">(" {{ $order->reason }} ")</span>
                                    @elseif($order->status == 3)
                                        Out for Delivery
                                    @elseif($order->status == 4)
                                        Delivered
                                    @endif
                                </h5>
                            </div>
                            <div>
                                <h6>Payment Status:</h6>
                                <h5 class="mt-2">
                                    @if($order->payment_status == 1)
                                        Pending
                                    @else
                                        Paid
                                    @endif
                                    <br>
                                    <span class="text-uppercase font-sm" style="font-size: 15px">( {{ $order->payment_option }} )</span>
                                </h5>
                            </div>
                            <div>
                                <h6>Order Amount:</h6>
                                <h5 class="mt-2">{{ $order->grand_total }} Tk</h5>
                            </div>
                        </div>
                        <div class="card-body row" style="margin: 0px !important;">
                            <div class="d-flex align-items-center justify-content-between border mobile-table">
                                <div class="col-md-8 border-right">
                                    <p style="padding-top: 16px"> Items </p>
                                </div>
                                <div class="col-md-2 border-right">
                                    <p style="padding-top: 16px"> Qty </p>
                                </div>
                                <div class="col-md-2" >
                                    <p style="padding-top: 16px"> Total Price </p>
                                </div>
                            </div>
                            @foreach($order->orderItems as $item)
                                <div class="d-flex justify-content-between border mobile-table">
                                    <div class="col-md-8 d-flex p-2 border-right mobile-table-td" style="column-gap: 50px; flex-direction: column">
                                        <a href="{{ route('products', $item->product->slug) }}"><img src="{{ asset($item->product->featured_image) }}" width="100px"></a>
                                        <div>
                                            <a href="{{ route('products', $item->product->slug) }}"><h4> {{ $item->product_name }} </h4></a>
                                            <p class="text-center">
                                                @if(isset($item->color)) Color : {{ $item->color }} x @endif
                                                @if(isset($item->size)) x Size : {{ $item->size }} @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 border-right">
                                        <p style="padding-top: 16px"> {{ $item->qty }} </p>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="padding-top: 16px"> {{ $item->total }} </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-footer row">
                            <div class="col-md-10 p-2 mobile-ship-width">
                                <h5> Shipping Details :</h5> <hr class="w-25">
                                <p> Name : {{ $order->first_name }} {{ $order->last_name }} </p>
                                <p> Email : {{ $order->email }} </p>
                                <p> Phone : {{ $order->phone }} </p>
                                <p> Address: {{ $order->address }} , {{ $order->state }} , {{ $order->country->name }}</p>

                                <h5 class="mt-4"> Payment Details :</h5> <hr class="w-25">
                                <p> Payment Method : @if($order->payment_option == 'cod') Cash On Delivery @endif </p>
                            </div>
                            <div class="col-md-2 d-flex flex-column align-items-center mobile-price-width">
                                <p class="text-center"> SubTotal : <strong>{{ $order->subtotal }} Tk </strong> </p>
                                <p class="text-center"> Discount : <strong>{{ $order->discount }} Tk </strong> <br><span class="font-sm">(Code: {{ $order->coupon_code }})</span></p>
                                <p class="text-center mt-2"> Shipping : <strong>{{ $order->shipping }} Tk </strong></p>
                                <p class="text-center mt-2"> Total Payable : <strong>{{ $order->grand_total }} Tk </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding: 0px !important;">
                <div class="card p-2 pt-3 pb-3 mt-2">
                    <h6 class="text-center"> Invoice </h6>
                    <a class="btn btn-primary" href="{{ asset($order->invoice) }}" target="_blank"> View Invoice </a>
                </div>

                <div class="card p-2 pt-3 pb-3">
                    <h6 class="text-center"> Order Status </h6>
                    <form method="post" action="{{ route('order-status-update', $order->id) }}" >
                        @csrf
                        <select class="form-control select-bottom-icon" name="status" id="order-status">
                            <option value="1" @if($order->status == 1) selected @endif > Pending </option>
                            <option value="2" @if($order->status == 2) selected @endif> Cancel </option>
                            <option value="3" @if($order->status == 3) selected @endif> Out for Delivery </option>
                            <option value="4" @if($order->status == 4) selected @endif> Delivered </option>
                        </select>
                        <input name="reason" class="form-control mt-2" id="cancel-reason" value="{{ $order->reason }}" placeholder=" Write Cancel Reason !" style="display:none">
                        <i class="bi bi-chevron-down select-bottom-icon-icon"></i>
                        <button type="submit" class="btn btn-sm btn-success mt-2"> Update Status </button>
                    </form>
                </div>

                <div class="card p-2 pt-3 pb-3 mt-2">
                    <h6 class="text-center"> Payment Status </h6>
                    <form method="post" action="{{ route('order-paymentStatus-update', $order->id) }}">
                        @csrf
                        <select class="form-control select-bottom-icon" name="payment_status">
                            <option value="1" @if($order->payment_status == 1) selected @endif> Pending </option>
                            <option value="2" @if($order->payment_status == 2) selected @endif> Paid </option>
                        </select>
                        <i class="bi bi-chevron-down select-bottom-icon-icon"></i>
                        <button type="submit" class="btn btn-sm btn-success mt-2">Update Status</button>
                    </form>
                </div>
            </div>
        </section>
    </div>



@endsection

@section('customjs')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('order-status');
            const reasonInput = document.getElementById('cancel-reason');

            // Function to show/hide reason input based on selected option
            function toggleReasonInput() {
                if (statusSelect.value === '2') {
                    reasonInput.style.display = 'block';
                } else {
                    reasonInput.style.display = 'none';
                }
            }

            // Initial check on page load
            toggleReasonInput();

            // Event listener for select dropdown
            statusSelect.addEventListener('change', toggleReasonInput);
        });
    </script>

@endsection


