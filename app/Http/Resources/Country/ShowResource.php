<?php

namespace App\Http\Resources\Country;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShowResource extends JsonResource
{
    /**
     * The 'country' wrapper that should be applied.
     * @var null|string
     */
    public static $wrap = 'country';

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'flag' => $this->flag,
            'idd' => $this->idd,
        ];
    }
}
