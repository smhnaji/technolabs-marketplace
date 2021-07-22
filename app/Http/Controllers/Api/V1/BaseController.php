<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param array $result
     * @param string $message
     * @param integer $statusCode
     * @return void
     * @return \Illuminate\Http\Response
     */
    public function responseSuccess($data, $message, $statusCode = 200)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param integer $statusCode
     * @return void
     */
    public function responseFailure($error, $errorMessages = [], $statusCode = 422)
    {
        $response = [
            'success'   => false,
            'data'      => $errorMessages,
            'message'   => $error,
        ];

        return response()->json($response, $statusCode);
    }
}
