<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        return view('admin.payment_methods.manage',[
            'payments' =>  PaymentMethod::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'payment_type' => 'required | unique:payment_methods',
        ]);
        if ($validator->passes()){

            PaymentMethod::saveInfo($request);
            return redirect(route('payment.index'));

        }else{
            return back()->withErrors($validator);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        PaymentMethod::statusCheck($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = PaymentMethod::find($id);

        $validator = Validator::make($request->all(), [
            'payment_type' => 'required|unique:payment_methods,payment_type,' . $payment->id . ',id'
        ]);

        if ($validator->passes()){

            PaymentMethod::saveInfo($request,$id);
            return redirect(route('payment.index'));

        }else{
            return back()->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $payment = PaymentMethod::find($id);

        if ($payment) {
            if (!empty($payment->image)) {
                // Get the image file path
                $imagePath = public_path($payment->image);

                // Check if the image file exists
                if (file_exists($imagePath)) {
                    // Delete the image file
                    unlink($imagePath);
                }

                // Delete the SubCategory record
                $payment->delete();
            }else{
                $payment->delete();
            }

        }

        return redirect(route('payment.index'));
    }
}
