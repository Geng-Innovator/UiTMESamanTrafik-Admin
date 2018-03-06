<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->command->info('Seeding lookup table');
    	$this->call(LookupTableSeeder::class);
	    $this->command->info('All lookup tables seeded!');

	    $this->command->info('Seeding user tables.');
	    $this->call(UserSeeder::class);
	    $this->command->info('All user tables seeded!');

	    $this->command->info('All required table were seeded.');
    }
}
