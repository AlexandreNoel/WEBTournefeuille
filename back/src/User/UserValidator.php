<?php
namespace User;

class UserValidator
{
    public function validate($user) {
        if (
            is_null($user) ||
            !property_exists($user, 'pseudo') ||
            !property_exists($user, 'email') ||
            !property_exists($user, 'password') ||
            strlen($user->password) < 3 ||
            strlen($user->pseudo) < 3 ||
            !filter_var($user->email, FILTER_VALIDATE_EMAIL)
        ) {
            return false;
        }
        return true;
    }
}
