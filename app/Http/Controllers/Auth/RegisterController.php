<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'image.mimes' => 'Please format your image to jpeg, jpg or png !!',
        ];

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required'],
            'work' => ['required'],
            'image' => ['required', 'mimes:jpeg,jpg,png'],
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        if ($data['work'] == '1'){
            $work = "Karyawan Swasta";
        } elseif ($data['work'] == '2') {
            $work = "Pegawai Negeri";
        } elseif ($data['work'] == '3') {
            $work = "Belum Bekerja";
        }

        
        $file = $data['image'];
        $namefile = $file->getClientOriginalName();
        $filename = str_random(3) . '-' . $namefile . '.jpg';
        $file->move('uploads/employee', $filename);
        

        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'work' => $work,
            'image' => $filename,
        ]);
    }
}
