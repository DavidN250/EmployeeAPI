<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'nationalID' => 'required|unique:employees,nationalID|min:16',
            'phone_number' => 'required|unique:employees,phone_number|min:10|max:13',
            'dob' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $employee= Employee::create([
            'name' => $fields['name'],
            'nationalID' => $fields['nationalID'],
            'phone_number' => $fields['phone_number'],
            'email' => $fields['email'],
            'dob' => $fields['dob']
        ]);

        $code = 'EMP'.(string)rand(0,9999);

        $employee->user_id = $user->id;
        $employee->code = $code;
        $employee->save();

        $token = $user->createToken('employeeAPIToken')->plainTextToken;

        $response = [
            'user' => $user,
            'employee'=> $employee,
            'token' => $token
        ];

        // email data
        $email_data = array(
            'name' => $fields['name'],
            'email' => $fields['email'],
            'company_name' => 'TaskForce',
        );

        // send email with the template
        Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Welcome to TaskForce')
                ->from('info@taskforce.com', 'TaskForce');
        });


        event(new Registered($user));

        Auth::login($user);

        return response($response, 201);

        // return redirect(RouteServiceProvider::HOME);
    }
}
