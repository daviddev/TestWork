<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository
{
    /**
     * @param array $requestData
     * @return Collection
     */
    public function listCountries(array $requestData): Collection
    {
        $search = $requestData['search'] ?? null;
        return Country::query()
            ->when(
                $search,
                fn($q) => $q->where('name', 'like', "%$search%")
            )
            ->get();
    }
}
