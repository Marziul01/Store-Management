<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Temp_Image;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\HttpFoundation\Session\Storage\save;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    use HasFactory;
    private static $product,$image,$imageUrl, $imageNewName,$dir,$slug,$action;

    public static function saveInfo($request, $id=null){
        if ($id != null){
            self::$product = Product::find($id);
            self::$action = 'updated';
        }else{
            self::$product = new Product();
            self::$action = 'added';
        }

        self::$product->name = $request->name;

        if (self::$product->slug != self::makeSlug($request) ){

            self::$product->slug = self::makeSlug($request);

        }else{
            self::$product->slug = self::makeSlug($request);
        }

        self::$product->desc = $request->desc;
        self::$product->buy_price = $request->buy_price;
        self::$product->price = $request->price;

        if($request->input('category_id')){
            self::$product->category_id = $request->category_id;
        }
        if($request->input('sub_category_id')){
            self::$product->sub_category_id = $request->sub_category_id;
        }
        if($request->input('brand_id')){
            self::$product->brand_id = $request->brand_id;
        }

        self::$product->sku = $request->sku;

        $newTotalqty = 0;
        if ($request->input('variations.qty')) {
            $totalqtys = $request->input('variations.qty');
            foreach ($totalqtys as $totalqty) {
                $newTotalqty += $totalqty;
            }
            self::$product->qty = $newTotalqty;
        } else {
            self::$product->qty = $request->qty;
        }


        if ($request->file('image')){
            if (self::$product->image){
                if (file_exists(self::$product->image)){
                    unlink(self::$product->image);
                }
            }
            self::$product->image = self::saveImage($request);
        }

        self::$product->save();

        if ($request->input('information.option')) {
            $options = $request->input('information.option');
            $optionValues = $request->input('information.optionValue');

            $existingInfos = ProductAdditionalInfo::where('product_id', $id)->get();
            if(isset($existingInfos)){
                foreach($existingInfos as $existingInfo) {
                    $existingInfo->delete();
                }
            }

            foreach ($options as $index => $option) {
                $optionValue = $optionValues[$index];
                    // Create new option
                    $information = new ProductAdditionalInfo();
                    $information->product_id = self::$product->id;
                    $information->option = $option;
                    $information->optionValue = $optionValue;
                    $information->save();
            }

            // Delete options that were not included in the update
            ProductAdditionalInfo::where('product_id', $id)
                ->whereNotIn('option', $options)
                ->whereNotIn('option', $optionValues)
                ->delete();
        }




        if ($request->input('variations.type')) {
            $types = $request->input('variations.type');
            $prices = $request->input('variations.price');
            $qtys = $request->input('variations.qty');

            $existingVariations = Variation::where('product_id', $id)->get();
            if(isset($existingVariations)){
                foreach($existingVariations as $existingVariation) {
                    $existingVariation->delete();
                }
            }

            foreach ($types as $index => $type) {
                $price = $prices[$index];
                $qty = $qtys[$index];
                    // Create new option
                    $Variation = new Variation();
                    $Variation->product_id = self::$product->id;
                    $Variation->type = $type;
                    $Variation->price = $price;
                    $Variation->qty = $qty;
                    $Variation->save();
            }

            // Delete options that were not included in the update
            Variation::where('product_id', $id)
                ->whereNotIn('type', $types)
                ->whereNotIn('qty', $qtys)
                ->delete();
        }

        $successMessage = "Product has been " . self::$action . " successfully";
        $request->session()->flash('success', $successMessage);
    }

    public static function makeSlug($request){
        if ($request->slug){
            self::$slug = Str::slug($request->slug, '-');
        }else{
            self::$slug = Str::slug($request->name, '-');
        }
        return self::$slug;
    }
    public static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageNewName = self::$product->slug.rand().'.'.self::$image->extension();
        self::$dir = "admin-assets/img/products/";
        self::$imageUrl = self::$dir.self::$imageNewName;
        self::$image->move(self::$dir,self::$imageUrl);
        return self::$imageUrl;
    }

    public static function statusCheck($id){
        self::$product = Product::find($id);
        if (self::$product->status == 1){
            self::$product->status = 0;
        }else{
            self::$product->status = 1;
        }

        self::$product->save();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function variations(){
        return $this->hasMany(Variation::class);
    }
    public function productAdditionalInfo(){
        return $this->hasMany(ProductAdditionalInfo::class);
    }
}
