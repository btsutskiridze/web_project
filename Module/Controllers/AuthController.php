<?php

class AuthController extends Controller
{
    public function register(): void
    {

        $validator = new Validator();

        $validator->setAttributes([
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Password Confirmation'
        ]);

        $validation = $validator->check($_POST, [
            'username' => ['required' => true, 'min' => 2, 'max' => 20, 'unique' => 'users'],
            'email' => ['required' => true, 'min' => 2, 'max' => 60, 'unique' => 'users', 'email' => true],
            'password' => ['required' => true, 'min' => 1,],
            'confirm_password' => ['required' => true, 'matches' => 'password']
        ]);


        if ($validation->passed()) {
            Session::flash('success', 'You registered successfully!');
            header('location:/');
        }

        $this->view('register', ['errors' => $validation->errors()]);
    }

    public function login(): void
    {

    }

}