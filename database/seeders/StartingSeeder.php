<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StartingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userId = DB::table('users')->insertGetId( [
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'test@test.com',
            'password' => Hash::make('12345678'),
            'phone' => '+1123121211',
        ]);

        $companyId = DB::table('companies')->insertGetId( [
            'title' => Str::random(10),
            'description' => Str::random(100),
            'phone' => '+1123121211',
        ]);

        DB::table('company_user')->insert([
            'user_id' => $userId,
            'company_id' => $companyId,
        ]);


    }
}
