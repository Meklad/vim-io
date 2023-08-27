<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse as Response;

trait JsonResponse
{
    /**
     * Handle json response.
     *
     * @param boolean $success
     * @param integer $status
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public function respond(
        bool $success = true,
        int $status = 200,
        string $message = "",
        array $data = []
    ): Response{
        return new Response($this->mapResponse(
            $success, $status, $message, $data
        ), $status);
    }

    /**
     * Map the response.
     *
     * @param boolean $success
     * @param integer $status
     * @param string $message
     * @param array $data
     * @return array
     */
    private function mapResponse(
        bool $success = true,
        int $status = 200,
        string $message = "",
        array $data = []
    ): array
    {
        $responseMap = [
            "success" => $success,
            "status" => $status
        ];

        if(!empty($message)) {
            $responseMap["message"] = $message;
        }

        if(count($data) > 0) {
            $responseMap["data"] = $data;
        }

        return $responseMap;
    }
}
