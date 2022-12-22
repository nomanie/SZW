<?php
namespace App\Http\Controllers\api\v1\Enums;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EnumsController extends Controller
{
    protected $enum;
    public function getOptions(string $enum, string $function = 'getList'): JsonResponse
    {
        $options = (new $enum)->$function();
        $newOptions = [];
        foreach ($options as $key => $value) {
            $newOptions[] = ['id' => $key, 'label' => $value];
        }
        return response()->json($newOptions);
    }
}
