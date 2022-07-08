<?php

namespace App\Http\Controllers\Client\Callboard;

use Domain\Callboard\Actions\CallboardDeleteAction;
use Domain\Callboard\Models\Callboard;
use Illuminate\Http\JsonResponse;

class CallboardDeleteController
{
    public function __invoke(
        Callboard $callboard,
        CallboardDeleteAction  $action,
    ): JsonResponse
    {
        $action->handle($callboard);

        return response()->json();
    }
}
