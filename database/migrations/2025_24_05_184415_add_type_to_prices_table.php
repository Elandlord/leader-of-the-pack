<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE prices MODIFY COLUMN type ENUM('Local Walks', 'Travel Walks', 'Daycare') DEFAULT 'Local Walks'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE prices MODIFY COLUMN type ENUM('Walks', 'Daycare') DEFAULT 'Walks'");
    }
};
