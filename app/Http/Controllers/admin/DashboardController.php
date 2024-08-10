<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use App\Notifications\NewContactNotification;
use App\Notifications\ProductQtyNotification;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard.dashboard',[
            'products' => Product::with('variations')->where('status', 1)->get(),
            'payments' => PaymentMethod::where('status', 1)->get(),
        ]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public static function notificationRead($id){
       $notification = DB::table('notifications')->where('id', $id)->first();
       if ($notification != Null){
           DB::table('notifications')
               ->where('id', $id)
               ->update(['read_at' => Carbon::now()]);

            if ($notification->type == 'App\Notifications\ProductQtyNotification'){
                return redirect(route('product.index'));
            }elseif ($notification->type == 'App\Notifications\NewOrderNotification'){
                return redirect(route('ordersPending'));
            }elseif ($notification->type == 'App\Notifications\NewUserNotification'){
                return redirect(route('users.index'));
            }elseif ($notification->type == 'App\Notifications\NewReviewNotfication'){
                return redirect(route('reviews'));
            }
            else{
                return back();
            }

        }else{
           return back();
       }
    }

    public function markAllAsRead(Request $request) {
        DB::table('notifications')->where('type', 'App\Notifications\NewContactNotification')->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }

}
