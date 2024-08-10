@extends('admin.master')

@section('title')
    Product Brands
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
            <h1 class="h3 mb-0 text-gray-800">Brand</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#AddBrandModal">
                <i class="bi bi-file-earmark-plus"></i> Add New</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped table-responsive-md zero-configuration">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Brand Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($brands->isNotEmpty())
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset( $brand->image ) }}" width="50px" height="50px"></td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    @if($brand->status == 1)
                                        <i class="bi bi-check-circle-fill" style="color: deepskyblue"></i> ACTIVE
                                    @else
                                        <i class="bi bi-x-circle-fill" style="color: red"></i> INACTIVE
                                    @endif
                                </td>
                                <td class="table-action-td d-flex align-items-center column-gap-3">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditBrandModal_{{ $brand->id }}"><i class="bi bi-pen-fill"></i> Edit</a>
                                    @if($brand->status == 1)
                                        <a class="btn btn-sm btn-warning" href="{{ route('brand.show', $brand->id) }}"><i class="bi bi-x-circle-fill"></i> Inactive</a>
                                    @else
                                        <a class="btn btn-sm btn-success" href="{{ route('brand.show', $brand->id) }}"><i class="bi bi-check-circle-fill"></i> Active</a>
                                    @endif

                                    <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Brand?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"> No Brands Found !!! </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $brands->links() }}
            </div>
        </div>

    </div>




    {{--    Add Category Model--}}

    <div class="modal fade" id="AddBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Brand
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug">
                            @error('slug')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
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
    @if(isset($brand))
        @foreach($brands as $brand)
            <div class="modal fade" id="EditBrandModal_{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content goes here, make sure to customize it for each category -->
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            Edit Brand
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $brand->id }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ $brand->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <p class="py-2">Previous Image: </p>
                                    <img src="{{ asset($brand->image) }}" width="100px" height="100px" >
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
    <script>
        $(document).ready(function() {
            // Your JavaScript code// Function to generate a slug
            function generateSlug() {
                var name = $('#name').val().toLowerCase().trim();
                var slug = name.replace(/[^a-z0-9-]+/g, '-');
                $('#slug').val(slug);
            }

            // Initialize slug based on the name input
            generateSlug();

            // Listen for changes in the name input and update the slug input
            $('#name').on('input', function() {
                generateSlug();
            }); here
        });
    </script>
@endsection


