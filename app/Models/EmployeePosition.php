<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;

    public static function saveInfo($request, $id=null){
        if ($id != null){
            $employee = EmployeePosition::find($id);
            $action = 'updated';
        }else{
            $employee = new EmployeePosition();
            $action = 'added';
        }

        $employee->positions = $request->positions;
        $employee->sub_positions = $request->sub_positions;

        $employee->save();

        $successMessage = "Employee Position has been " . $action . " successfully";
        $request->session()->flash('success', $successMessage);
    }

    public static function statusCheck($id){
        $employee = EmployeePosition::find($id);
        if ($employee->status == 1){
            $employee->status = 0;
        }else{
            $employee->status = 1;
        }

        $employee->save();
    }
}
