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
        $this->call('ProductsTableSeeder');
        $this->call('StoresTableSeeder');
        $this->call('ReviewsTableSeeder');
        $this->call('ProductStoresTableSeeder');
    }
}
