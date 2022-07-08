<?php

namespace App\Http\Controllers\Client\Callboard;

use App\Http\Requests\Callboard\CallboardCreateRequest;
use Domain\Callboard\Actions\CallboardCreateAction;
use Illuminate\Http\JsonResponse;

class CallboardCreateController
{
    public function __invoke(
        CallboardCreateRequest $request,
        CallboardCreateAction  $action,
    ): JsonResponse
    {
        $action->handle($request->data());

        return response()->json();
    }
}
