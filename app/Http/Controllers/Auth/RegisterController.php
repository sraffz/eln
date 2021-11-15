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
    protected $redirectTo = '/';

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
        
        return Validator::make($data, [
            'nama'           => 'required',
            'nokp'           => 'required|unique:Users|max:255',
            'email'          => 'required|email',
            'jawatan'           => 'required',
            'jantina'           => 'required',
            'gredKod'           => 'required',
            'gredAngka'           => 'required',
            'jabatan'           => 'required',
            'password'       => 'required|min:6|confirmed',
            ], [
            'nama.required'           => 'Nama wajib di isi.',
            'nokp.required'           => 'No Kad Pengenalan wajib di isi.',
            'email.required'          => 'Alamat emel wajib di isi.',
            'jawatan.required'       => 'Jawatan wajib di isi.',
            'jantina.required'       => 'Jantina wajib di isi.',
            'gredKod.required'       => 'Gred Kod wajib di isi.',
            'gredAngka.required'       => 'Gred Angka wajib di isi.',
            'jabatan.required'       => 'Jabatan wajib di isi.',
            'password.required'       => 'Katalaluan wajib di isi.',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'jawatan' => $data['jawatan'],
            'jantina' => $data['jantina'],
            'gredKod' => $data['gredKod'],
            'gredAngka' => $data['gredAngka'],
            'jabatan' => $data['jabatan'],
            'nokp' => $data['nokp'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
