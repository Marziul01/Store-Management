<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public static function saveInfo($request, $id=null){
        if ($id != null){
            $employee = Employee::find($id);
            $action = 'updated';
        }else{
            $employee = new Employee();
            $action = 'added';
        }

        $employee->employee_positions_id = $request->employee_positions_id;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        if($request->status != null){
            $employee->status = $request->status;
        }

        if ($request->file('image')){
            if ($employee->image){
                if (file_exists($employee->image)){
                    unlink($employee->image);
                }
            }
            $employee->image = self::saveImage($request);
        }

        $employee->save();

        $successMessage = "Employee has been " . $action . " successfully";
        $request->session()->flash('success', $successMessage);
    }

    public static function saveImage($request){
        $image = $request->file('image');
        $imageNewName = $request->name.rand().'.'.$image->extension();
        $dir = "admin-assets/img/employees/";
        $imageUrl = $dir.$imageNewName;
        $image->move($dir,$imageUrl);
        return $imageUrl;
    }

    public function employeePosition() {
        return $this->belongsTo(EmployeePosition::class, 'employee_positions_id');
    }
}
