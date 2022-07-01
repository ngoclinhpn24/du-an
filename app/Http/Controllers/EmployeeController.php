<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    //Quản lý tất cả người dùng khách hàng
    public function manageEmployee(){
        $employee = Employee::orderBy('id','DESC')->get();
    
        return view('admin.manage_employee')->with(compact('employee'));
       }
    
       //Xóa người dùng
       public function deleteEmployee($employee_id){
        $employee = Employee::find($employee_id);
        $employee->delete();
    
        return redirect()->back();
       }
    
       //Thêm người dùng mới
       public function addEmployee(){
           return view('admin.add_employee');
       }
    
       //Lưu người dùng mới
       public function insertEmployee(Request $request){
        $data = $request->all();
            $employee = new Employee();
            $employee->employee_name = $data['name'];
            $employee->employee_phone = $data['phone'];
            $employee->employee_address = $data['address'];
            $employee->employee_email = $data['email'];
            $employee->employee_job = $data['job'];
            $employee->save();
            Session::put('message','Thêm nhân viên mới thành công');
    
            return Redirect::to('manage-employee');
        }
    
    
}
