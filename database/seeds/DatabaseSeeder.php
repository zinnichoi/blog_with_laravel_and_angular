<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $userId = factory(\App\Models\User::class)->create()->id;
            factory(\App\Models\Blog::class, 5)->create([
                'user_id' => $userId
            ]);
        }
    }
}
