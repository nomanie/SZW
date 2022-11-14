<?php
namespace App\Http\Controllers\api\v1\Enums;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EnumsController extends Controller
{
    protected $enum;
    public function getOptions(string $enum): JsonResponse
    {
        $options = (new $enum)->getList();
        return response()->json($options);
    }
}
