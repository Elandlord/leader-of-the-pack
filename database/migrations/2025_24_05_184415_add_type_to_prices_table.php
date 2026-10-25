<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->changeTypeOnSqlite(['Local Walks', 'Travel Walks', 'Daycare'], 'Local Walks');

            return;
        }

        DB::statement("ALTER TABLE prices MODIFY COLUMN type ENUM('Local Walks', 'Travel Walks', 'Daycare') DEFAULT 'Local Walks'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->changeTypeOnSqlite(['Walks', 'Daycare'], 'Walks');

            return;
        }

        DB::statement("ALTER TABLE prices MODIFY COLUMN type ENUM('Walks', 'Daycare') DEFAULT 'Walks'");
    }

    private function changeTypeOnSqlite(array $types, string $default): void
    {
        Schema::table('prices', function (Blueprint $table) use ($types, $default) {
            $table->enum('type', $types)->default($default)->change();
        });
    }
};
