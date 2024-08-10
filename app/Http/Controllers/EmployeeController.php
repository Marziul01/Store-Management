<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('employeePosition')->get();
        return view('admin.employee.employee', [
            'employees' => $employees,
            'positions' => EmployeePosition::where('status', 1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'employee_positions_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->passes()){

            Employee::saveInfo($request);
            return redirect(route('employee.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $Employee = Employee::find($id);

        $validator = Validator::make($request->all(), [
            'employee_positions_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->passes()){

            Employee::saveInfo($request,$id);
            return redirect(route('employee.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Employee = Employee::find($id);

        if ($Employee) {
            if (!empty($Employee->image)) {
                // Get the image file path
                $imagePath = public_path($Employee->image);

                // Check if the image file exists
                if (file_exists($imagePath)) {
                    // Delete the image file
                    unlink($imagePath);
                }

                // Delete the SubCategory record
                $Employee->delete();
            }else{
                $Employee->delete();
            }

        }

        return redirect(route('employee.index'));
    }
}
