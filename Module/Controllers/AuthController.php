<?php

class AuthController extends Controller
{
    /**
     * @throws Exception
     */
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
            'password' => ['required' => true, 'min' => 6,],
            'confirm_password' => ['required' => true, 'matches' => 'password']
        ]);


        if ($validation->passed()) {
            (new User)->create([
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
                'group' => 1,
            ]);
            Session::put('success', 'You registered successfully!');
            Redirect::to('/register');
        }


        $this->view('/register', ['errors' => $validation->errors()]);
    }

    public function login(): void
    {

    }

}