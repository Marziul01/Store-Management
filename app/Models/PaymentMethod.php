<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    private static $payment,$image,$imageUrl, $imageNewName,$dir,$slug,$action;

    public static function saveInfo($request, $id=null){
        if ($id != null){
            self::$payment = PaymentMethod::find($id);
            self::$action = 'updated';
        }else{
            self::$payment = new PaymentMethod();
            self::$action = 'added';
        }

        self::$payment->payment_type = $request->payment_type;
        self::$payment->charge = $request->charge;

        if ($request->file('image')){
            if (self::$payment->image){
                if (file_exists(self::$payment->image)){
                    unlink(self::$payment->image);
                }
            }
            self::$payment->image = self::saveImage($request);
        }

        self::$payment->save();

        $successMessage = "Payment Method has been " . self::$action . " successfully";
        $request->session()->flash('success', $successMessage);
    }

    public static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageNewName = self::$payment->slug.rand().'.'.self::$image->extension();
        self::$dir = "admin-assets/img/payment/";
        self::$imageUrl = self::$dir.self::$imageNewName;
        self::$image->move(self::$dir,self::$imageUrl);
        return self::$imageUrl;
    }

    public static function statusCheck($id){
        self::$payment = PaymentMethod::find($id);
        if (self::$payment->status == 1){
            self::$payment->status = 0;
        }else{
            self::$payment->status = 1;
        }

        self::$payment->save();
    }
}
