<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\SiteSetting;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class OrderController extends Controller
{
    public static function index(){
        return view('admin.order.pending',[
            'admin' => Auth::guard('admin')->user(),
            'siteSettings' => SiteSetting::where('id', 1)->first(),
            'orders' => Order::whereIn('status', [1, 3])->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public static function ordersComplete(){
        return view('admin.order.completed',[
            'admin' => Auth::guard('admin')->user(),
            'siteSettings' => SiteSetting::where('id', 1)->first(),
            'orders' => Order::where('status', 4)->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public static function ordersCancel(){
        return view('admin.order.cancelled',[
            'admin' => Auth::guard('admin')->user(),
            'siteSettings' => SiteSetting::where('id', 1)->first(),
            'orders' => Order::where('status', 2)->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public static function viewOrders($id){
        return view('admin.order.orderDetail',[
            'admin' => Auth::guard('admin')->user(),
            'siteSettings' => SiteSetting::where('id', 1)->first(),
            'order' => Order::find($id),
        ]);
    }

    public static function saveOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'variations' => 'array',
            'variations.*' => 'nullable|exists:variations,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:1,2,3,4', // 1: Paid, 2: Paid (Divided), 3: Pending
        ]);

        if($request->payment_status == '4'){
            $validator->addRules([
                'payment_method_1' => 'required',
                'advancePay' => 'required',
            ]);
        }

        // Additional validation for 'Paid (Divided)' status
        if ($request->payment_status == '2') { // 'Paid (Divided)'
            $validator->addRules([
                'payment_amount' => 'required|array',
                'payment_amount.*' => 'numeric|min:0',
                'payment_method' => 'required|array',
                'payment_method.*' => 'exists:payment_methods,id',
            ]);

            $amounts = $request->input('payment_amount', []);
            $totalAmount = array_sum($amounts);
            $totalPrice = $request->input('total_price', 0);

            if ($totalAmount != $totalPrice) {
                return response()->json([
                    'success' => false,
                    'errors' => ['The total payment amounts must equal the total price.']
                ]);
            }
        }

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        // Check quantity availability
        $products = $request->input('products', []);
        $variations = $request->input('variations', []);
        $quantities = $request->input('quantities', []);

        $bypassQuantityCheck = $request->input('bypass_quantity_check', false);
        $errors = [];

        if (!$bypassQuantityCheck) {
            foreach ($request['products'] as $index => $productId) {
                $quantity = $request['quantities'][$index];
                $variationId = $request['variations'][$index] ?? null;

                if ($variationId) {
                    $variation = Variation::find($variationId);
                    $productInfo = Product::find($productId);
                    if($variation->qty > 0){
                        $text = 'Only'. $variation->qty ;
                    }else{
                        $text = 'NO';
                    }
                    if (!$variation || $variation->qty < $quantity) {
                        $errors[] = "$productInfo->name ($variation->type) $quantity quantity not available. $text items left.";
                    }
                } else {
                    $product = Product::find($productId);
                    if($product->qty > 0){
                        $text = 'Only'. $product->qty ;
                    }else{
                        $text = 'NO';
                    }
                    if (!$product || $product->qty < $quantity) {
                        $errors[] = "$product->name $quantity quantity not available. $text items left.";
                    }
                }
            }

            if (!empty($errors)) {
                return response()->json([
                    'success' => false,
                    'errors' => $errors
                ]);
            }
        }

        Order::saveInfo($request);

        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }


    public static function orderStatusUpdate(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->status;
        if ($request->status == 2){
            $order->reason = $request->reason;
        }
        $order->save();
        return back()->with(session()->flash('success', 'Order Status Updated'));
    }

    public static function orderPaymentStatusUpdate(Request $request, $id){
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->save();
        return back()->with(session()->flash('success', 'Order Payment Status Updated'));
    }
}
