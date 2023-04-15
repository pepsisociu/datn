<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Throwable message
     *
     * @param $request
     * @param Exception|Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception|Throwable $e)
    {
        if ($e instanceof RoleAdminException){
            return $this->handleRoleAdminException($request, $e);
        } else{dd($e->getMessage());
            return redirect(route('screen_home'));
        }        
    }

        
    /**
     * Handle role admin exception
     *
     * @param  mixed $request
     * @param  mixed $e
     * @return void
     */
    public function handleRoleAdminException($request, $e){
        return redirect(route('screen_admin_login'))->with('message', $e->getMessage());  
    }
}
