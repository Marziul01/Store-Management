
@extends('admin.master')

@section('title')
     Store Managment Dashboard
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <a href="#" data-toggle="modal" data-target="#AddOrder">
                    <div class="card gradient-2" style="margin-bottom: 0px">
                        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 0.88rem 1.81rem;">
                            <h3 class="card-title text-white" style="margin-bottom: 0px !important"><i class="bi bi-plus-circle-fill"></i> Add New Order</h3>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Products Sold</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">4565</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Net Profit</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">$ 8541</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">New Customers</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">4565</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Customer Satisfaction</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">99%</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-0 d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-1">Product Sales</h4>
                                    <p>Total Earnings of the Month</p>
                                    <h3 class="m-0">$ 12,555</h3>
                                </div>
                                <div>
                                    <ul>
                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                        <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_2"></canvas>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="w-100 mr-2">
                                        <h6>Pixel 2</h6>
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar bg-danger" style="width: 40%"></div>
                                        </div>
                                    </div>
                                    <div class="ml-2 w-100">
                                        <h6>iPhone X</h6>
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-widget">
                    <div class="card-body">
                        <h5 class="text-muted">Order Overview </h5>
                        <h2 class="mt-4">5680</h2>
                        <span>Total Revenue</span>
                        <div class="mt-4">
                            <h4>30</h4>
                            <h6>Online Order <span class="pull-right">30%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>50</h4>
                            <h6 class="m-t-10 text-muted">Offline Order <span class="pull-right">50%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"><span class="sr-only">50% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>20</h4>
                            <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-0">
                        <h4 class="card-title px-4 mb-3">Todo</h4>
                        <div class="todo-list">
                            <div class="tdl-holder">
                                <div class="tdl-content">
                                    <ul id="todo_list">
                                        <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox"><i></i><span>Don't give up the fight.</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox" checked><i></i><span>Do something else</span><a href='#' class="ti-trash"></a></label></li>
                                    </ul>
                                </div>
                                <div class="px-4">
                                    <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('admin-assets') }}/images/users/8.jpg" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">Ana Liem</h5>
                            <p class="m-0">Senior Manager</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('admin-assets') }}/images/users/5.jpg" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">John Abraham</h5>
                            <p class="m-0">Store Manager</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('admin-assets') }}/images/users/7.jpg" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">John Doe</h5>
                            <p class="m-0">Sales Man</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('admin-assets') }}/images/users/1.jpg" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">Mehedi Titas</h5>
                            <p class="m-0">Online Marketer</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="active-member">
                            <div class="table-responsive">
                                <table class="table table-xs mb-0">
                                    <thead>
                                    <tr>
                                        <th>Customers</th>
                                        <th>Product</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Activity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Sarah Smith</td>
                                        <td>iPhone X</td>
                                        <td>
                                            <span>United States</span>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class=" rounded-circle mr-3" alt="">Walter R.</td>
                                        <td>Pixel 2</td>
                                        <td><span>Canada</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">50 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/3.jpg" class=" rounded-circle mr-3" alt="">Andrew D.</td>
                                        <td>OnePlus</td>
                                        <td><span>Germany</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/6.jpg" class=" rounded-circle mr-3" alt=""> Megan S.</td>
                                        <td>Galaxy</td>
                                        <td><span>Japan</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/4.jpg" class=" rounded-circle mr-3" alt=""> Doris R.</td>
                                        <td>Moto Z2</td>
                                        <td><span>England</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ asset('admin-assets') }}/images/avatar/5.jpg" class=" rounded-circle mr-3" alt="">Elizabeth W.</td>
                                        <td>Notebook Asus</td>
                                        <td><span>China</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">

                <div class="card">
                    <div class="chart-wrapper mb-4">
                        <div class="px-4 pt-4 d-flex justify-content-between">
                            <div>
                                <h4>Sales Activities</h4>
                                <p>Last 6 Month</p>
                            </div>
                            <div>
                                <span><i class="fa fa-caret-up text-success"></i></span>
                                <h4 class="d-inline-block text-success">720</h4>
                                <p class=" text-danger">+120.5(5.0%)</p>
                            </div>
                        </div>
                        <div>
                            <canvas id="chart_widget_3"></canvas>
                        </div>
                    </div>
                    <div class="card-body border-top pt-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li>5% Negative Feedback</li>
                                    <li>95% Positive Feedback</li>
                                </ul>
                                <div>
                                    <h5>Customer Feedback</h5>
                                    <h3>385749</h3>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="chart_widget_3_1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Activity</h4>
                        <div id="activity">
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/1.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>Received New Order</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>iPhone develered</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>3 Order Pending</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>Join new Manager</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>Branch open 5 min Late</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media border-bottom-1 pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/2.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>New support ticket received</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                            <div class="media pt-3 pb-3">
                                <img width="35" src="{{ asset('admin-assets') }}/images/avatar/3.jpg" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>Facebook Post 30 Comments</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-sm-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Store Location</h4>
                        <div id="world-map" style="height: 470px;"></div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-facebook">
                        <span class="s-icon"><i class="fa fa-facebook"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-linkedin">
                        <span class="s-icon"><i class="fa fa-linkedin"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-googleplus">
                        <span class="s-icon"><i class="fa fa-google-plus"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-twitter">
                        <span class="s-icon"><i class="fa fa-twitter"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create New Order Modal --}}

    <div class="modal fade dashboard-OrderModal" id="AddOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Order
                </div>
                <div class="modal-body">
                    <form id="orderForm" class="OrderFormModal">
                        @csrf
                        <div id="OrderDivs" class="mb-2"></div>
                        <button type="button" class="btn btn-primary w-100 addProductbtn" onclick="addOrder()">Add New Product</button>

                        <div class="d-flex w-100 column-gap-3 align-items-center OrderPayment">
                            <div class="w-75 paymentDetailsDiv">
                                <select class="form-control" id="payments" name="payment_method_1">
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}"> {{ $payment->payment_type }} </option>
                                    @endforeach
                                </select>
                                <input type="number" name="advance_payment" id="advancePay" class="form-control" placeholder="Advance Amount" style="display:none;">
                                <div id="dividedPayments" style="display: none" class="paymentDiv">
                                    <div class="payment-set">
                                        <select class="form-control" name="payment_method[]">
                                            @foreach ($payments as $payment)
                                                <option value="{{ $payment->id }}"> {{ $payment->payment_type }} </option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="number" name="payment_amount[]" placeholder="Amount" oninput="updateDividedAmounts(1)">
                                    </div>
                                    <div class="payment-set mt-2">
                                        <select class="form-control" name="payment_method[]">
                                            @foreach ($payments as $payment)
                                                <option value="{{ $payment->id }}"> {{ $payment->payment_type }} </option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="number" name="payment_amount[]" placeholder="Amount" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="w-25 paymentStatusDiv">
                                <select class="form-control" id="status" name="payment_status" onchange="toggleDividedPayments(this.value)">
                                    <option value="1" selected> Paid </option>
                                    <option value="2"> Paid (Divided) </option>
                                    <option value="4"> Advance Payment </option>
                                    <option value="3"> Pending </option>
                                </select>
                            </div>
                        </div>

                        <div class="extraInfo mt-2">
                            <input class="form-control" type="text" name="name" placeholder="Customer Name (optional)">
                            <input class="form-control" type="number" name="phone" placeholder="Customer Number (optional)">
                            <input class="form-control" type="number" name="discount" placeholder="Discount Amount (optional)" oninput="applyDiscount()">
                            <div class="totallPrice"><strong>Total Price: </strong> <span id="totalPrice">0</span></div>
                            <input type="hidden" id="totalPriceInput" name="total_price" value="0">
                        </div>

                        <button type="submit" class="btn btn-success w-3 mt-3 orderFormSubmit p-2">Confirm Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customJs')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    // Existing form submission script
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        let formData = new FormData(this); // Gather form data

        // AJAX request using the Laravel route helper
        fetch('{{ route("saveOrder") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message); // Show success message
                document.getElementById('orderForm').reset();
                document.getElementById('OrderDivs').innerHTML = '';
                addOrder(); // Reset form inputs
                updateTotalPrice(); // Reset total price
                document.getElementById('dividedPayments').style.display = 'none';
                document.getElementById('payments').style.display = 'block';
            } else {
                // Handle validation errors
                if (data.errors) {
                    // Check if errors are quantity errors
                    if (data.errors.length > 0 && data.errors[0].includes('quantity')) {
                        // Show the popup for quantity errors
                        showPopup(data.errors);
                    } else {
                        // Show other validation errors
                        Object.keys(data.errors).forEach(key => {
                            toastr.error(data.errors[key]); // Show error message
                        });
                    }
                } else {
                    toastr.error(data.message); // Show general error message
                }
            }
        })
        .catch(error => {
            toastr.error('An error occurred while submitting the form.'); // Show generic error message
        });
    });

    // Function to show a popup message with options to continue or edit quantities
    function showPopup(messages) {
        // Create the popup HTML
        let popupHtml = `
            <div id="errorPopup" class="popup-overlay">
                <div class="popup-content">
                    <h4>Quantity Errors</h4>
                    <ul>
                        ${messages.map(message => `<li>${message}</li>`).join('')}
                    </ul>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <button id="continueButton" class="btn btn-primary">Continue</button>
                        <button id="editButton" class="btn btn-secondary">Edit Quantities</button>
                    </div>
                </div>
            </div>
        `;

        // Append popup HTML to the body
        document.body.insertAdjacentHTML('beforeend', popupHtml);

        // Add event listeners to buttons
        document.getElementById('continueButton').addEventListener('click', function() {
            document.getElementById('errorPopup').remove(); // Remove the popup
            bypassQuantityCheck = true; // Set flag to bypass quantity check
            submitFormWithBypass(); // Resubmit the form with bypass flag
        });

        document.getElementById('editButton').addEventListener('click', function() {
            document.getElementById('errorPopup').remove(); // Remove the popup
            // Focus or highlight the form for editing
            document.getElementById('orderForm').scrollIntoView();
        });
    }

    // Flag to bypass quantity check
    let bypassQuantityCheck = false;

    function submitFormWithBypass() {
        let formData = new FormData(document.getElementById('orderForm'));
        formData.append('bypass_quantity_check', true); // Add flag to form data

        fetch('{{ route("saveOrder") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message); // Show success message
                document.getElementById('orderForm').reset();
                document.getElementById('OrderDivs').innerHTML = '';
                addOrder(); // Reset form inputs
                updateTotalPrice(); // Reset total price
                document.getElementById('dividedPayments').style.display = 'none';
                document.getElementById('payments').style.display = 'block';
            } else {
                // Handle validation errors
                if (data.errors) {
                    // Show other validation errors
                    Object.keys(data.errors).forEach(key => {
                        toastr.error(data.errors[key]); // Show error message
                    });
                } else {
                    toastr.error(data.message); // Show general error message
                }
            }
        })
        .catch(error => {
            toastr.error('An error occurred while submitting the form.'); // Show generic error message
        });
    }

    // Function to clear divided amounts if needed
    function clearDividedAmounts() {
        // Clear divided payment amounts logic here
    }
</script>


<script>

let products = @json($products);

    document.addEventListener('DOMContentLoaded', () => {
    addOrder();
    document.getElementById('status').addEventListener('change', toggleDividedPayments);
    document.querySelector('input[name="discount"]').addEventListener('input', updateTotalPrice);
});


function addOrder() {
    let orderDivs = document.getElementById('OrderDivs');
    let div = document.createElement('div');
    div.className = 'order-item mb-2';

    let selectProduct = document.createElement('select');
    selectProduct.name = 'products[]';
    selectProduct.className = 'form-control';
    selectProduct.required = true;
    selectProduct.onchange = function() { updateProductSelection(this); };

    let defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.innerHTML = 'Select a product';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    selectProduct.appendChild(defaultOption);

    products.forEach(product => {
        let option = document.createElement('option');
        option.value = product.id;
        option.dataset.price = product.price;
        option.dataset.hasVariations = product.variations.length > 0;
        option.innerHTML = product.name + ' (' + product.price.toFixed(2) + ')';
        selectProduct.appendChild(option);
    });

    let variationSelect = document.createElement('select');
    variationSelect.name = 'variations[]';
    variationSelect.className = 'form-control';
    variationSelect.style.display = 'none';
    variationSelect.onchange = function() { updatePrice(selectProduct); };

    let quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.name = 'quantities[]';
    quantityInput.className = 'form-control';
    quantityInput.placeholder = 'Quantity';
    quantityInput.required = true;
    quantityInput.min = 1;
    quantityInput.value = 1;
    quantityInput.oninput = function() { updatePrice(selectProduct); };

    let priceDisplay = document.createElement('span');
    priceDisplay.className = 'price-display';
    priceDisplay.innerHTML = 'Price: 0.00';

    let removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger';
    removeButton.innerHTML = 'Remove';
    removeButton.onclick = function() { removeOrder(div); };

    div.appendChild(selectProduct);
    div.appendChild(variationSelect);
    div.appendChild(quantityInput);
    div.appendChild(priceDisplay);
    div.appendChild(removeButton);
    orderDivs.appendChild(div);
}

function updateProductSelection(selectElement) {
    let div = selectElement.closest('.order-item');
    let variationSelect = div.querySelector('select[name="variations[]"]');
    let selectedOption = selectElement.options[selectElement.selectedIndex];
    let productId = selectedOption.value;

    variationSelect.innerHTML = '';
    variationSelect.style.display = 'none';

    if (productId && selectedOption.dataset.hasVariations === "true") {
        let variations = products.find(p => p.id == productId).variations;
        if (variations.length > 0) {
            variationSelect.style.display = 'block';

            let defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.innerHTML = 'Select a variation';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            variationSelect.appendChild(defaultOption);

            variations.forEach(variation => {
                let option = document.createElement('option');
                option.value = variation.id;
                option.dataset.price = variation.price;
                option.innerHTML = variation.type + ' (+' + variation.price.toFixed(2) + ')';
                variationSelect.appendChild(option);
            });
        }
    }

    updatePrice(selectElement);
}

function updatePrice(selectElement) {
    let div = selectElement.closest('.order-item');
    let quantityInput = div.querySelector('input[name="quantities[]"]');
    let variationSelect = div.querySelector('select[name="variations[]"]');
    let priceDisplay = div.querySelector('.price-display');

    let basePrice = parseFloat(selectElement.options[selectElement.selectedIndex].dataset.price);
    let quantity = parseFloat(quantityInput.value || 1);
    let variationPrice = 0;

    if (variationSelect.style.display !== 'none' && variationSelect.value) {
        let selectedVariation = variationSelect.options[variationSelect.selectedIndex];
        variationPrice = parseFloat(selectedVariation.dataset.price);
    }

    let totalProductPrice = (basePrice + variationPrice) * quantity;
    priceDisplay.innerHTML = 'Price: ' + totalProductPrice.toFixed(2);
    updateTotalPrice();
}

function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll('.order-item').forEach(item => {
        if (item.style.display !== 'none') {
            let selectElement = item.querySelector('select[name="products[]"]');
            let quantityInput = item.querySelector('input[name="quantities[]"]');
            let variationSelect = item.querySelector('select[name="variations[]"]');

            if (selectElement.value) {
                let selectedOption = selectElement.options[selectElement.selectedIndex];
                let basePrice = parseFloat(selectedOption.dataset.price);
                let quantity = parseFloat(quantityInput.value || 1);
                let variationPrice = 0;

                if (variationSelect.style.display !== 'none' && variationSelect.value) {
                    let selectedVariation = variationSelect.options[variationSelect.selectedIndex];
                    variationPrice = parseFloat(selectedVariation.dataset.price);
                }

                total += (basePrice + variationPrice) * quantity;
            }
        }
    });

    let discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
    total = Math.max(0, total - discount); // Ensure total is not negative

    document.getElementById('totalPrice').innerHTML = total.toFixed(2);
    document.getElementById('totalPriceInput').value = total.toFixed(2); // Update hidden input field
}

function toggleDividedPayments() {
    const statusSelect = document.getElementById('status');
    const payments = document.getElementById('payments');
    const dividedPayments = document.getElementById('dividedPayments');
    const advancePayment = document.getElementById('advancePay');

    if (statusSelect.value == "2") { // "Paid (Divided)"
        payments.style.display = 'none'; // Hide payment select input
        dividedPayments.style.display = 'block'; // Show divided payments
        advancePayment.style.display = 'none'; // Hide advance payment
    } else if (statusSelect.value == "4") { // Some other condition (e.g., Advance Payment)
        payments.style.display = 'block';
        dividedPayments.style.display = 'none'; // Hide divided payments
        advancePayment.style.display = 'block'; // Show advance payment
    } else if (statusSelect.value == "3") { // Some other condition (e.g., Pending Payment)
        payments.style.display = 'none'; // Hide payment select input
        dividedPayments.style.display = 'none'; // Hide divided payments
        advancePayment.style.display = 'none'; // Hide advance payment
    } else {
        payments.style.display = 'block'; // Show payment select input
        dividedPayments.style.display = 'none'; // Hide divided payments
        advancePayment.style.display = 'none'; // Hide advance payment
        clearDividedAmounts(); // Clear amounts
    }
}


function clearDividedAmounts() {
    document.querySelectorAll('input[name="payment_amount[]"]').forEach(input => {
        input.value = '';
    });
}



function clearDividedAmounts() {
    document.querySelector('input[name="payment_amount_1"]').value = '';
    document.querySelector('input[name="payment_amount_2"]').value = '';
}

function updateDividedAmounts(index) {
    const total = parseFloat(document.getElementById('totalPriceInput').value) || 0;
    const amountInputs = document.querySelectorAll('input[name="payment_amount[]"]');
    let amount1 = parseFloat(amountInputs[0].value) || 0;
    let amount2 = parseFloat(amountInputs[1].value) || 0;

    if (index === 1) {
        amount1 = Math.min(amount1, total);
        amountInputs[1].value = (total - amount1).toFixed(2);
    } else {
        amount2 = Math.min(amount2, total);
        amountInputs[0].value = (total - amount2).toFixed(2);
    }
}


function removeOrder(div) {
    div.remove();
    updateTotalPrice();
}


function removeRemovedItems() {
    document.querySelectorAll('.order-item.removed').forEach(item => {
        item.remove(); // Remove the hidden items before form submission
    });
    return true; // Allow form submission
}

</script>

@endsection
