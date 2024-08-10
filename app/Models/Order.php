<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static function saveInfo($request, $id = null) {
        if ($id != null) {
            $order = Order::find($id);
        } else {
            $order = new Order();
        }

        $totalPrice = $request->total_price;

        if ($request->discount != null) {
            $order->total = $totalPrice + $request->discount;
            $order->discount = $request->discount;
            $order->grand_total = $totalPrice;
        } else {
            $order->grand_total = $totalPrice;
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->payment_status = $request->payment_status;

        if($request->payment_status == '3'){
            $order->status = 3;
        }
        if($request->payment_status == '4'){
            $order->status = 2;
        }

        $order->save();

        // Process Order Items
        foreach ($request['products'] as $index => $productId) {
            $quantity = $request['quantities'][$index];
            $variationId = $request['variations'][$index] ?? null;

            $orderItem = OrderItem::where('order_id', $order->id)
                ->where('product_id', $productId)
                ->where('variation_id', $variationId)
                ->first();

            if (!$orderItem) {
                $orderItem = new OrderItem();
            }

            $product = Product::find($productId);
            $price = $product->price;

            if ($variationId) {
                $variation = Variation::find($variationId);

                if ($variation) {
                    $price += $variation->price;
                    $variation->qty = ($variation->qty) - $quantity;
                    $variation->save();
                }

                // Update product quantity to reflect the quantity of the variation ordered
                $product->qty = ($product->qty) - $quantity;
                $product->save();
            } else {
                // No variation, only update product quantity
                $product->qty = ($product->qty) - $quantity;
                $product->save();
            }

            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->qty = $quantity;
            $orderItem->variation_id = $variationId;
            $orderItem->total = $price * $quantity;
            $orderItem->save();
        }

        // Process Payment Details
        if ($request->payment_status == '2') { // 'Paid (Divided)'
            foreach ($request['payment_method'] as $index => $payment_method_id) {
                $amount = $request['payment_amount'][$index];

                // Find the payment method by its ID
                $paymentMethod = PaymentMethod::find($payment_method_id);

                if (!$paymentMethod) {
                    throw new \Exception("Payment method ID $payment_method_id is invalid.");
                }

                $payment = PaymentDetail::where('order_id', $order->id)
                    ->where('payment_method_id', $paymentMethod->id)
                    ->first();

                if (!$payment) {
                    $payment = new PaymentDetail();
                }

                $payment->order_id = $order->id;
                $payment->payment_method_id = $paymentMethod->id;
                $payment->phone = $request->phone;
                $payment->payment_method = $paymentMethod->payment_type;
                $payment->amount = $amount;
                $payment->save();
            }
        }

        if($request->payment_status == '1' || $request->payment_status == '4'){
            $payment_method_id = $request->payment_method_1;

            // Find the payment method by its ID
            $paymentMethod = PaymentMethod::find($payment_method_id);

            if (!$paymentMethod) {
                throw new \Exception("Payment method ID $payment_method_id is invalid.");
            }

            $payment = PaymentDetail::where('order_id', $order->id)
                ->where('payment_method_id', $paymentMethod->id)
                ->first();

            if (!$payment) {
                $payment = new PaymentDetail();
            }

            $payment->order_id = $order->id;
            $payment->payment_method_id = $paymentMethod->id;
            $payment->phone = $request->phone;
            $payment->payment_method = $paymentMethod->payment_type;

            if($request->payment_status == '1'){
                $payment->amount = $order->grand_total;
            }else{
                $payment->amount = $request->advance_payment;
            }

            $payment->save();
        }

    }
}
