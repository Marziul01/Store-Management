@extends('admin.master')

@section('title')
    Edit Products
@endsection

@section('content')
    <script>
        // Encode PHP array as a JSON string and output it as a JavaScript variable
        var existingData = @json($existingData);

        // Call the populateExistingData function with the existing data
        document.addEventListener("DOMContentLoaded", function() {
            populateExistingData(existingData);
        });
    </script>
    <script>
        // Encode PHP array as a JSON string and output it as a JavaScript variable
        var variationsData = @json($variationsData);

        // Call the populateExistingData function with the existing data
        document.addEventListener("DOMContentLoaded", function() {
            populateVariationsData(variationsData);
        });
    </script>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="alert-ul">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <!-- Default box -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card mb-3">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $product->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title">Slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $product->slug }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="desc" class="form-control">{{ $product->desc }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product Image</h2>
                                    <div id="featured-image" class="">
                                        <div class="dz-message needsclick">
                                            <input type="file" name="image" id="featured-image-upload" accept="image/*">
                                        </div>
                                        <div id="featured-image-preview" class="image-preview">
                                            <h6>Previous Image :</h6><br>
                                            <img src="{{ asset($product->image) }}" width="100px" height="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Pricing</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Buying Price</label>
                                                <input type="text" name="buy_price" id="buy_price" class="form-control" placeholder="Buying Price" value="{{ $product->buy_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="{{ $product->price }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Inventory</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="sku">SKU (Stock Keeping Unit)</label>
                                                <input type="text" name="sku" id="sku" class="form-control" placeholder="sku" value="{{ $product->sku }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty" value="{{ $product->qty }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div id="additionalInfoContainer" class="card-body">
                                    <!-- Existing data will be populated here by JavaScript -->
                                </div>

                                <!-- Add button to trigger adding new information -->
                                <button type="button" onclick="addNewInfo()" class="btn btn-primary">Add New Info</button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4  mb-3">Product category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option>Select A Category</option>
                                            @if($categories->isNotEmpty())
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category">Sub category</label>
                                        <select name="sub_category_id" id="sub_category" class="form-control">
                                            <option value="">Select a Sub Category</option>
                                            @if(isset($product))
                                                <option value="{{ $product->sub_category_id }}" selected>{{ $product->subCategory->name }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <div class="mb-3">
                                        <select name="brand_id" id="brand" class="form-control">
                                            <option value="">Select A Brand</option>
                                            @if($brands->isNotEmpty())
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div id="variationsContainer" class="card-body">
                                    <!-- Existing data will be populated here by JavaScript -->
                                </div>

                                <!-- Add button to trigger adding new information -->
                                <button type="button" onclick="addNewVariations()" class="btn btn-primary">Add New Variations</button>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>

            </form><!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('customJs')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder: {
                    uploadUrl: "{{ route('ck.upload',['_token'=> csrf_token()]) }}",
                }
            } )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script>
        $("#category").change(function () {
            var category_id = $(this).val();
            $.ajax({
                url: '{{ route("product-subcategories") }}',
                type: 'get',
                data: { category_id: category_id },
                dataType: 'json',
                success: function (response) {
                    $("#sub_category").find("option").not(":first").remove();
                    $.each(response["subCategory"], function (key, item) {
                        $("#sub_category").append(`<option value='${item.id}'>${item.name}</option>`);
                    });
                },
                error: function () {
                    console.log("Something Went Wrong!");
                }
            });
        });
    </script>

    {{-- Edit previews --}}


    <script>
        function populateExistingData(existingData) {
            var container = document.getElementById("additionalInfoContainer");

            existingData.forEach(function(data) {
                var input1 = createInput("text", "information[option][]", "Option Name", "form-control w-50", data.option);
                var input2 = createInput("text", "information[optionValue][]", "Informations", "form-control w-50", data.optionValue);
                var hiddenInput = createInput("hidden", "information[existing][]", "", "", "1");

                var deleteButton = createDeleteButton(data.id); // Pass the ID of the data to be deleted

                var infoContainer = document.createElement("div");
                infoContainer.className = "additional-info d-flex mb-2";

                infoContainer.appendChild(input1);
                infoContainer.appendChild(input2);
                infoContainer.appendChild(hiddenInput);
                infoContainer.appendChild(deleteButton);

                container.appendChild(infoContainer);

                // Attach event listener to the delete button
                deleteButton.addEventListener("click", function() {
                    // Call a function to delete data from the database using data.id
                    deleteDataFromDatabase(data.id);
                    // Remove the infoContainer from the DOM
                    container.removeChild(infoContainer);
                });
            });
        }

        function addNewInfo() {
            var container = document.getElementById("additionalInfoContainer");

            var input1 = createInput("text", "information[option][]", "Option Name", "form-control w-50");
            var input2 = createInput("text", "information[optionValue][]", "Informations", "form-control w-50");
            var closeButton = createCloseButton();

            var infoContainer = document.createElement("div");
            infoContainer.className = "additional-info d-flex mb-2";

            infoContainer.appendChild(input1);
            infoContainer.appendChild(input2);
            infoContainer.appendChild(closeButton);

            container.appendChild(infoContainer);

            // Attach event listener to the close button
            closeButton.addEventListener("click", function() {
                container.removeChild(infoContainer);
            });
        }

        function createDeleteButton(id) {
            var deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.innerHTML = "<i class='bi bi-x-circle-fill'></i> Delete";
            deleteButton.className = "btn btn-danger ml-2";
            deleteButton.dataset.id = id; // Store the ID as a data attribute

            return deleteButton;
        }

        function createCloseButton() {
            var closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.innerHTML = "<i class='bi bi-x-circle-fill'></i> Close";
            closeButton.className = "btn btn-danger ml-2";

            return closeButton;
        }

        function createInput(type, name, placeholder, className, value) {
            var input = document.createElement("input");
            input.type = type;
            input.name = name;
            input.placeholder = placeholder;
            input.className = className;
            input.value = value || ""; // Set the value if it exists

            return input;
        }

        function deleteDataFromDatabase(id) {
            // Add your logic here to delete data from the database using the provided ID
            // You may use AJAX or any other method to communicate with your server
            console.log("Deleting data with ID: " + id);
        }
    </script>

    {{-- Script For Variations --}}

    <script>
        function populateVariationsData(variationsData) {
            var container = document.getElementById("variationsContainer");

            variationsData.forEach(function(data) {
                var input1 = createInput("text", "variations[type][]", "Variations Type", "form-control w-50", data.type);
                var input2 = createInput("text", "variations[price][]", "Extra Price", "form-control w-50", data.price);
                var input3 = createInput("number", "variations[qty][]", "Quantity", "form-control w-50", data.qty);
                var hiddenInput = createInput("hidden", "variations[existing][]", "", "", "1");

                var deleteButton = createDeleteButton(data.id); // Pass the ID of the data to be deleted

                var infoContainer = document.createElement("div");
                infoContainer.className = "additional-info d-flex mb-2";

                infoContainer.appendChild(input1);
                infoContainer.appendChild(input2);
                infoContainer.appendChild(input3);
                infoContainer.appendChild(hiddenInput);
                infoContainer.appendChild(deleteButton);

                container.appendChild(infoContainer);

                // Attach event listener to the delete button
                deleteButton.addEventListener("click", function() {
                    // Call a function to delete data from the database using data.id
                    deleteDataFromDatabase(data.id);
                    // Remove the infoContainer from the DOM
                    container.removeChild(infoContainer);
                });
            });
        }

        function addNewVariations() {
            var container = document.getElementById("variationsContainer");

            var input1 = createInput("text", "variations[type][]", "Variation Type", "form-control w-50");
            var input2 = createInput("text", "variations[price][]", "Extra Price", "form-control w-50");
            var input3 = createInput("number", "variations[qty][]", "Quantity", "form-control w-50");
            var closeButton = createCloseButton();

            var infoContainer = document.createElement("div");
            infoContainer.className = "additional-info d-flex mb-2";

            infoContainer.appendChild(input1);
            infoContainer.appendChild(input2);
            infoContainer.appendChild(input3);
            infoContainer.appendChild(closeButton);

            container.appendChild(infoContainer);

            // Attach event listener to the close button
            closeButton.addEventListener("click", function() {
                container.removeChild(infoContainer);
            });
        }

        function createDeleteButton(id) {
            var deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.innerHTML = "<i class='bi bi-x-circle-fill'></i> Delete";
            deleteButton.className = "btn btn-danger ml-2";
            deleteButton.dataset.id = id; // Store the ID as a data attribute

            return deleteButton;
        }

        function createCloseButton() {
            var closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.innerHTML = "<i class='bi bi-x-circle-fill'></i> Close";
            closeButton.className = "btn btn-danger ml-2";

            return closeButton;
        }

        function createInput(type, name, placeholder, className, value) {
            var input = document.createElement("input");
            input.type = type;
            input.name = name;
            input.placeholder = placeholder;
            input.className = className;
            input.value = value || ""; // Set the value if it exists

            return input;
        }

        function deleteDataFromDatabase(id) {
            // Add your logic here to delete data from the database using the provided ID
            // You may use AJAX or any other method to communicate with your server
            console.log("Deleting data with ID: " + id);
        }
    </script>





@endsection

