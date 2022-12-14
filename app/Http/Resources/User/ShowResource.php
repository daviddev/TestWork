<?php

namespace App\Http\Resources\User;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShowResource extends JsonResource
{
    /**
     * The 'user' wrapper that should be applied.
     * @var null|string
     */
    public static $wrap = 'user';

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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'country' => $this->userCountry->country->name,
            'phone_number' => $this->phoneBook->phone_number,
        ];
    }
}
