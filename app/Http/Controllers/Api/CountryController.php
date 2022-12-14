<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\IndexRequest;
use App\Http\Resources\Country\ShowResourceCollection;
use App\Repositories\CountryRepository;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * @param CountryRepository $repository
     */
    public function __construct(private CountryRepository $repository)
    {
        //
    }

    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $countries = $this->repository->listCountries($request->validated());
        return (new ShowResourceCollection($countries))->response();
    }
}
