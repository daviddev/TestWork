<?php

namespace App\Http\Resources\Country;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ShowResourceCollection extends ResourceCollection
{
    /**
     * The 'countries' wrapper that should be applied.
     * @var null|string
     */
    public static $wrap = '';

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ShowResource::class;
}
