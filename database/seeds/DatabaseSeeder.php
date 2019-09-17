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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'type' => 0,
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('WifiGroup')->insert([
            'GroupName' => 'GFS',
            'MaxConcurrent' => 0,
            'Upload' => 0,
            'Download' => 0,
            'Redirect' => 'https://google.com',
            'Description' => 'Guest Room Full Speed',
            'Status' => 'A',
            'Type' => 'G',
            'info' => 'Default Group do not delete!! this Group design for hotel guest',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('WifiGroup')->insert([
            'GroupName' => 'FFS',
            'MaxConcurrent' => 0,
            'Upload' => 0,
            'Download' => 0,
            'Redirect' => 'https://google.com',
            'Description' => 'Function Full Speed',
            'Status' => 'A',
            'Type' => 'I',
            'info' => 'Default Group do not delete!! this Group design for event function or hotel staff',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::connection('mysql2')->table('radgroupreply')->insert([
            'groupname' => 'GFS',
            'attribute' => 'WISPr-Redirection-URL',
            'op' => ':=',
            'value' => 'http://www.google.com/',
        ]);

        DB::connection('mysql2')->table('radgroupreply')->insert([
            'groupname' => 'GFS',
            'attribute' => 'WISPr-Redirection-URL',
            'op' => ':=',
            'value' => 'http://www.google.com/',
        ]);
    }
}
