@extends('admin.master')

@section('title')
    All Products
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                @include('admin.auth.message')
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Products</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration" style="overflow-x: auto;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset( $product->image ) }}" width="50px" height="50px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>@if(isset($product->category->name))
                                        {{ $product->category->name }}
                                            @if(isset($product->subCategory->name)) > {{ $product->subCategory->name }} @endif
                                        @else No Category Selected
                                        @endif
                                    </td>
                                    <td>{{ $product->qty }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @if($product->status == 1)
                                            <i class="bi bi-check-circle-fill" style="color: deepskyblue"></i> ACTIVE
                                        @else
                                            <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                        @endif
                                    </td>
                                    <td class="table-action-td d-flex align-items-center coluimn-gap-3">
                                        <a class="btn btn-sm btn-primary" href="{{ route('product.edit', $product->id) }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                        @if($product->status == 1)
                                            <a class="btn btn-sm btn-warning" href="{{ route('product.show', $product->id) }}"><i class="bi bi-x-circle-fill"></i> Inactive</a>
                                        @else
                                            <a class="btn btn-sm btn-success" href="{{ route('product.show', $product->id) }}"><i class="bi bi-check-circle-fill"></i> Active</a>
                                        @endif

                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </form>
                                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#productViewModal_{{ $product->id }}"><i class="bi bi-eye"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8"> No Products Found !!! </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    @if(isset($product))
        @foreach($products as $product)
            <div class="modal fade" id="productViewModal_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between align-content-center">
                            <h5>{{ $product->name }}</h5>
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column justify-content-center align-items-center border-bottom-1">
                                <img src="{{ asset($product->image) }}" height="100px" class="mb-2">
                                <p class="text-center mt-2 mb-2 px-5">Description: {{ $product->desc }}</p>
                            </div>
                            <div class="row px-3" >
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Slug: {{ $product->slug }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Status: {{ $product->status == 1 ? 'ACTIVE' : 'INACTIVE'}}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Quantity: {{ $product->qty}}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Product SKU: {{ $product->sku}}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Category: {{ $product->category->name }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Sub Category: {{ $product->Subcategory->name }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Brand: {{ $product->brand->name }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Price: {{ $product->price }}</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Buying Price: {{ $product->buy_price }}</p>
                                </div>

                                @if ($product->variations->isNotEmpty())
                                <p class="w-100 text-center border-bottom-1 mt-2 pb-2">Variations : </p>
                                @foreach ($product->variations as $variation)
                                <div class="col-md-4 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p>Variation Type: {{ $variation->type }}</p>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Extra Price: {{ $variation->price }}</p>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>Qty: {{ $variation->qty }}</p>
                                </div>
                                @endforeach
                                @endif

                                @if ($product->productAdditionalInfo->isNotEmpty())
                                <p class="w-100 text-center border-bottom-1 mt-2 pb-2">Additional Info : </p>
                                @foreach ($product->productAdditionalInfo as $info)
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 border-right-1 py-2">
                                    <p> {{ $info->option }} :</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center border-bottom-1 py-2">
                                    <p>{{ $info->optionValue }}</p>
                                </div>
                                @endforeach
                                @endif

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

