<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required',
        'nationalID' => 'required|unique:employees,nationalID|min:16',
        'phone_number' => 'required|unique:employees,phone_number|min:10|max:13',
        'email' => 'required|unique:employees,email',
        'dob' => 'required',
        ]);


        $now = time(); // today
        $dob = strtotime($request->dob);
        $datediff = ceil(($now - $dob)/86400); //difference in days
        $years_old = (int)($datediff/365);     //converted in years

        if ($years_old < 18) {
            return response([
                'message' => 'Employee must be atleast 18 years old' 
            ], 401);
        }
        // $user =  Auth::user();

        $code = 'EMP'.(string)rand(0,9999);

        $employee = Employee::create($request->all());
        $employee->code = $code;
        $employee->save();

        // email data
        $email_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'company_name' => 'TaskForce',
        );

        // send email with the template
        Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Welcome to TaskForce')
                ->from('info@taskforce.com', 'TaskForce');
        });
        
        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Employee::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());

        return $employee;
    }

    /**
     * Activate or deactivate an employee
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $employee = Employee::find($id);

        if ($employee->status == 'ACTIVE') {
            $employee->status = 'INACTIVE';
        }
        else if ($employee->status == 'INACTIVE'){
           $employee->status = 'ACTIVE'; 
        }
        
        $employee->save();

        return $employee;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Employee::destroy($id);
    }


    /**
     * Search an employee .
     *
     * @param  str  $keyword
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        return Employee::where('name','like','%'.$keyword.'%')
                            ->orWhere('nationalID', 'like', '%' . $keyword . '%')
                            ->orWhere('code', 'like', '%' . $keyword . '%')
                            ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                            ->orWhere('email', 'like', '%' . $keyword . '%')
                            ->get();
    }
}

