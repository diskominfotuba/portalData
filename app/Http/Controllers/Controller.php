<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;

abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function warning(string $message = 'Error!', int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'success'   => false,
            'message'   => $message,
        ], $code);
    }

    protected function error($message = 'Error!', $errors = '', int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'success'   => false,
            'message'   => $message,
            'errors'    => $errors
        ], $code);
    }

    protected function success($data, $message = 'Success!', int $code = Response::HTTP_OK)
    {
        $response = [
            'code'      => $code,
            'success'   => true,
            'message'   => $message,
        ];

        if (!is_null($data)) {
            $response['metadata'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function info($message = 'Success!', int $code = Response::HTTP_OK)
    {
        $response = [
            'code'      => $code,
            'success'   => true,
            'message'   => $message,
        ];
        return response()->json($response, $code);
    }

    protected function responseWithPaginate($message, $data, $page, $limit, $total)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'metadata' => $data,
            'meta' => [
                'current_page' => $page,
                'per_page' => $limit,
                'total' => $total,
                'last_page' => ceil($total / $limit),
            ],
        ], Response::HTTP_OK);
    }


    protected function buildPagination($paginator)
    {
        return [
            'current_page' => $paginator->currentPage(),
            'has_more' => $paginator->hasMorePages(),
        ];
    }
}
