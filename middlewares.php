<?php

$guest = function () {
    if ((new User)->isLoggedIn())
        Redirect::to('/profile');
};

$auth = function () {
    if (!(new User)->isLoggedIn())
        Redirect::to('/login');
};