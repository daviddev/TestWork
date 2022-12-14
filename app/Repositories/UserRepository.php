<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserRepository
{
    /**
     * @param array $requestData
     * @return Builder|Model
     */
    public function storeUser(array $requestData): Model|Builder
    {
        try {
            DB::beginTransaction();
            $user = User::query()->create(Arr::only($requestData, ['full_name', 'email']));

            $user->phoneBook()->create([
                'phone_number' => $requestData['phone_number'],
            ]);

            $user->userCountry()->create([
                'country_id' => $requestData['country_id'],
            ]);

            DB::commit();

            $user->load(['userCountry.country', 'phoneBook']);
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }
}
