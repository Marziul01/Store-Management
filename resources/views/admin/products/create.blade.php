@extends('admin.master')

@section('title')
    ADD New Product
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Product</h1>
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
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title">Slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="desc" class="form-control"></textarea>
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
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Price</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Buying Price</label>
                                                <input type="text" name="buy_price" id="buy_price" class="form-control" placeholder="Buying Price" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" placeholder="Price" required>
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
                                                <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h4>Additional Information</h4>
                                        <div id="additionalInfoContainer" class="mb-2"></div>
                                        <button type="button" class="btn btn-primary w-100" onclick="addNewInfo()">Add New Additional Information</button>
                                    </div>
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
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category">Sub category</label>
                                        <select name="sub_category_id" id="sub_category" class="form-control">
                                            <option>Select a Sub Category</option>

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
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4>Variations</h4>
                                    <div id="variationsContainer" class="mb-2"></div>
                                    <button type="button" class="btn btn-primary w-100" onclick="addVariations()">Add Variations</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
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

    <script type="text/javascript">

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg,image/webp",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }, success: function(file, response){
                var html = `<div class="col-md-3" id="product-image-row-${response.image_id}">
                            <div class="card image-card">
                                <a href="#" onclick="deleteImage(${response.image_id});" class="btn btn-danger">Delete</a>
                                <img src="${response.imagePath}" class=" w-100 " height="100px">
                                <div class="card-body" style="display: none">
                                    <input type="hidden" name="image_id[]" value="${response.image_id}"/>
                                </div>
                            </div>
                        </div>`;
                $("#image-wrapper").append(html);
                $("button[type=submit]").prop('disabled',false);
                this.removeFile(file);
            }
        });





        function deleteImage(id){
            if (confirm("Are you sure you want to delete?")) {
                $("#product-image-row-"+id).remove();
            }
        }
    </script>

    <script>
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

        function createCloseButton() {
            var closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.innerHTML = "Close";
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
    </script>

    <script>
        function addVariations() {
            var container = document.getElementById("variationsContainer");

            var input1 = createInput("text", "variations[type][]", "Variations Type", "form-control w-50");
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

        function createCloseButton() {
            var closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.innerHTML = "Close";
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
    </script>

@endsection

