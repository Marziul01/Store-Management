<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employee.positions',[
            'employeePositions' => EmployeePosition::where('status',1)->get(),
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
        $validator = Validator::make($request->all(), [
            'positions' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (is_null($request->input('sub_positions'))) {
                        $exists = DB::table('employee_positions')
                                    ->whereNull('sub_positions')
                                    ->where('positions', $value)
                                    ->exists();
                        if ($exists) {
                            $fail('The ' . $attribute . ' has already been taken for entries without sub-positions.');
                        }
                    }
                }
            ],
            'sub_positions' => 'nullable|unique:employee_positions,sub_positions',
        ]);
        if ($validator->passes()){

            EmployeePosition::saveInfo($request);
            return redirect(route('employeePosition.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        EmployeePosition::statusCheck($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'positions' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $id) {
                    if (is_null($request->input('sub_positions'))) {
                        $exists = DB::table('employee_positions')
                                    ->whereNull('sub_positions')
                                    ->where('positions', $value)
                                    ->where('id', '!=', $id)
                                    ->exists();
                        if ($exists) {
                            $fail('The ' . $attribute . ' has already been taken for entries without sub-positions.');
                        }
                    }
                }
            ],
            'sub_positions' => 'nullable|unique:employee_positions,sub_positions,' . $id,
        ]);
        if ($validator->passes()){

            EmployeePosition::saveInfo($request,$id);
            return redirect(route('employeePosition.index'));

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = EmployeePosition::find($id);

        if ($employee) {
            $employee->delete();
            return redirect(route('employeePosition.index'));
        }
    }
}
