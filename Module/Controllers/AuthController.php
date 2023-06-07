<?php

class AuthController extends Controller
{
    public function loginView(): void
    {
        $this->view('/login');
    }

    public function registerView(): void
    {
        $this->view('/register');
    }


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


        if (!$validation->passed()) {
            $this->view('/register', ['errors' => $validation->errors()]);
            return;
        }

        (new User)->create([
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'group' => 1,
        ]);

        Session::put('message', 'You registered successfully!');
        Redirect::to('/register');
    }

    public function login(): void
    {
        $validator = new Validator();

        $validator->setAttributes([
            'email' => 'Email',
            'password' => 'Password',
        ]);


        $validation = $validator->check($_POST, [
            'email' => ['required' => true, 'min' => 2, 'max' => 60, 'email' => true],
            'password' => ['required' => true, 'min' => 6,],
        ]);

        if (!$validation->passed()) {
            $this->view('/login', ['errors' => $validation->errors()]);
            return;
        }

        $remember = Input::get('remember') === 'on';

        if ((new User)->login(Input::get('email'), Input::get('password'), $remember)) {
            Redirect::to('/profile');
            return;
        }

        $this->view('/login', ['errors' => ['password' => 'Wrong email or password']]);
    }

    public function logout(): void
    {
        (new User)->logout();
        Redirect::to('/login');
    }
}