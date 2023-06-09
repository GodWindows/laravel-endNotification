<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Existing migration code
        
        // Add a single line of data to the table
        DB::table('admins')->insert([ 
            'email' => 'kanlinsougodwin@gmail.com',
        ]);
        DB::table('admins')->insert([ 
            'email' => 'sakigbe95@gmail.com',
        ]);
        
        // Existing migration code
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the data added in the up method
        DB::table('admins')->where('email', 'kanlinsougodwin@gmail.com')->delete();
        DB::table('admins')->where('email', 'sakigbe95@gmail.com')->delete();
        
        // Existing rollback code
    }
};
