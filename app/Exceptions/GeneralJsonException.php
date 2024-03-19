<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * -Creating custom exception classes in our app can ensure consistent API responses 
 * for error handling
 * 
 * -The report() method is responsible for reporting (e.g mail) or logging the exception.
 * 
 * -The render() method is responsible to send the error back to the HTTP client.
 * 
 * -The abort() helper function is a quick way to send back an error response.
 * 
 * -The report() helper function calls the report() method in the specified exception class.
 * 
 */
class GeneralJsonException extends Exception
{
    protected $code = 422;
    
    /**
     * Report the exception
     * 
     * @return void
     */

    public function report()
    {
        dump('send email or log error');
    }

    /**
     * Render the exception as an HTTP response.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return JsonResponse
     */

     public function render($request)
     {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
     }
}
