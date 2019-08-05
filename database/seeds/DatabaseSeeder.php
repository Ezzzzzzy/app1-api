<?php

use Illuminate\Database\Seeder;

use App\{Permission, User, Role};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 2)->create();
        factory(User::class, 10)->create();
    }
}
