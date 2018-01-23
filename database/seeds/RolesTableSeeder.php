<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
		    [
		    	'id'			=> 1,
	    		'name' 			=> 'superadmin',
	    		'display_name' 	=> 'Super admin',
		    ],
            [
                'id'			=> 2,
                'name' 			=> 'admin',
                'display_name' 	=> 'Admin',
            ],
		]);
    }
}
