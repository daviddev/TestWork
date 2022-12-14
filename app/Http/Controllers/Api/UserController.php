<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\User\ShowResource;
use App\Jobs\SendMailSmsJob;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @param UserRepository $repository
     */
    public function __construct(private UserRepository $repository)
    {
        //
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $user = $this->repository->storeUser($request->validated());
        SendMailSmsJob::dispatch($user);
        $message = __('response.user.created');
        return (new ShowResource($user))
            ->additional(compact('message'))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
