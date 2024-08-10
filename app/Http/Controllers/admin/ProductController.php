<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\SiteSetting;
use App\Models\SubCategory;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductAdditionalInfo;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.manage',[
            'products' => Product::latest()->paginate(10),
            'variations' => Variation::all(),
            'infos' => ProductAdditionalInfo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.products.create',[
            'categories' => Category::where('status',1)->get(),
            'brands' => Brand::where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules=[
            'name' => 'required',
            'slug' => 'required | unique:products',
            'price' => 'required | numeric',
            'sku' => 'nullable | unique:products',
            'qty' => 'required | numeric',
        ];


        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()){
            Product::saveInfo($request);
            return redirect(route('product.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Product::statusCheck($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        return view('admin.products.edit',[
            'categories' => Category::where('status',1)->get(),
            'brands' => Brand::where('status',1)->get(),
            'product' => Product::find($id),
            'existingData' => ProductAdditionalInfo::where('product_id', $id)->get(),
            'variationsData' => Variation::where('product_id', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        $rules=[
            'name' => 'required',
            'slug' => 'required | unique:products,slug,' . $product->id . ',id',
            'price' => 'required | numeric',
            'image' => 'nullable',
            'sku' => 'nullable | unique:products,sku,'.$product->id.',id',
            'qty' => 'required | numeric',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()){
            Product::saveInfo($request,$id);
            return redirect(route('product.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            if (!empty($product->featured_image)) {
                // Get the image file path
                $imagePath = public_path($product->featured_image);

                // Check if the image file exists
                if (file_exists($imagePath)) {
                    // Delete the image file
                    unlink($imagePath);
                }

                // Delete the SubCategory record
                $product->delete();
            }else{
                $product->delete();
            }

        }

        return redirect(route('product.index'));
    }


}
