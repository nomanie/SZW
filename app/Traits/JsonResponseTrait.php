<?php
namespace App\Traits;


use App\Enums\ResponseCodeEnum;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

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
     *
     * @param string $message - wiadomość
     * @param int $status - status odpowiedzi
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function errorJsonResponse(string $message = '', int $status = 400, ?array $data = null): JsonResponse
    {
        return new JsonResponse(['message' => $message, 'data' => $data], $status);
    }

    /** Zwraca pozytywną odpowiedź zaktualizowania zasobu
     *
     * @param string $message - wiadomość
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function successUpdateResponse(string $message = '', ?array $data = null): JsonResponse
    {
        return $this->successJsonResponse($message, ResponseCodeEnum::OK->value, $data);
    }

    /** Zwraca pozytywną odpowiedź utworzenia zasobu
     *
     * @param string $message - wiadomość
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function successCreateResponse(string $message = '', ?array $data = null): JsonResponse
    {
        return $this->successJsonResponse($message, ResponseCodeEnum::CREATE->value, $data);
    }

    /** Zwraca pozytywną odpowiedź usunięcia zasobu
     *
     * @param string $message - wiadomość
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function successDeleteResponse(string $message = '', ?array $data = null): JsonResponse
    {
        return $this->successJsonResponse($message, ResponseCodeEnum::DELETE->value, $data);
    }

    /** Zwraca odpowiedź nie znaleziono zasobu
     *
     * @param string $message - wiadomość
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function NotFoundResponse(string $message = '', ?array $data = null): JsonResponse
    {
        return $this->successJsonResponse($message, ResponseCodeEnum::NOTFOUND->value, $data);
    }

    /** Zwraca odpowiedź błędne zapytanie
     *
     * @param string $message - wiadomość
     * @param array|null $data - dane
     *
     * @return JsonResponse
     */
    public function BadRequestResponse(string $message = '', ?array $data = null): JsonResponse
    {
        return $this->successJsonResponse($message, ResponseCodeEnum::BADREQUEST->value, $data);
    }
}
