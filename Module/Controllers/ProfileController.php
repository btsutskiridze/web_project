<?php


class ProfileController extends Controller
{
    public function index(): void
    {
        $user = new User;

        $this->view('profile', ['user' => $user->data(), 'posts' => $user->posts()]);
    }
}