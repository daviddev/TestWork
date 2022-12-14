<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(storage_path('app/countries/countries.json')), true);
        foreach ($countries as &$country) {
            $country['created_at'] = now();
            $country['updated_at'] = now();
        }
        Country::query()->insert($countries);
    }
}
