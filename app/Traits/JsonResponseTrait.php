<?php
namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait JsonResponseTrait {
    /** Zwraca pozytywną odpowiedź
     * @param string $message - wiadomość
     * @param int $status - status odpowiedzi
     * @param array|null $data - dane
     * @return JsonResponse
     */
    public function successJsonResponse(string $message = '', int $status = 200, ?array $data = null): JsonResponse
    {
        return new JsonResponse(['message' => $message, 'data' => $data], $status);
    }

    /** Zwraca błędną odpowiedź
     * @param string $message - wiadomość
     * @param int $status - status odpowiedzi
     * @param array|null $data - dane
     * @return JsonResponse
     */
    public function errorJsonResponse(string $message = '', int $status = 400, ?array $data = null): JsonResponse
    {
        return new JsonResponse(['message' => $message, 'data' => $data], $status);
    }
}
