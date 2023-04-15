<?php

namespace App\Traits;

trait ValidateTraits
{

    /**
     * Validate login
     *
     * @param $request
     * @return void
     */
    public function validateLogin($request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    }

    /**
     * Validate register
     *
     * @param $request
     * @return void
     */
    public function validateRegister($request)
    {
        $request->validate([
            'email' => 'required',
            'username' => 'required',
            'name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
    }

    /**
     * Validate forgot password
     *
     * @param $request
     * @return void
     */
    public function validateForgotPassword($request)
    {
        $request->validate([
            'email' => 'required',
        ]);
    }

    /**
     * Validate reset password
     *
     * @param $request
     * @return void
     */
    public function validateResetPassword($request)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
    }

    /**
     * Validate category
     *
     * @param $request
     * @return void
     */
    public function validateCategory($request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    }

    /**
     * Validate product
     *
     * @param $request
     * @return void
     */
    public function validateProduct($request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
    }
}
