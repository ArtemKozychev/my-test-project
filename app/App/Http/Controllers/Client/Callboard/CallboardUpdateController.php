<?php

namespace App\Http\Controllers\Client\Callboard;

use App\Http\Requests\Callboard\CallboardUpdateRequest;
use Domain\Callboard\Actions\CallboardUpdateAction;
use Domain\Callboard\Models\Callboard;
use Illuminate\Http\JsonResponse;

class CallboardUpdateController
{
    public function __invoke(
        Callboard $callboard,
        CallboardUpdateRequest $request,
        CallboardUpdateAction  $action,
    ): JsonResponse
    {
        $action->handle($callboard, $request->data());

        return response()->json();
    }
}
