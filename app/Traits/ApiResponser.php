<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

    /**
     * Undocumented function
     *
     * @param string|array $data
     * @param [type] $code
     * @return void
     */
    public function successResponse(string|array $data, int $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Undocumented function
     *
     * @param string|array $message
     * @param integer $code
     * @return void
     */
    public function errorResponse(string|array $message, int $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}