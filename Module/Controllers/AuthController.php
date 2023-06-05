<?php

class AuthController extends Controller
{
    public function register(): void
    {
        $errors = [];

        if (Input::exists()) {
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
                'password' => ['required' => true, 'min' => 6,],
                'confirm_password' => ['required' => true, 'matches' => 'password']
            ]);

            $validation->passed() ? header('Location: login.php') : $errors = $validation->errors();
        }

        $this->view('register', ['errors' => $errors]);
    }

    public function login(): void
    {

    }

}