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
        //

		DB::statement('ALTER TABLE posts ADD FOREIGN KEY(user_id) REFERENCES user(user_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		DB::statement('ALTER TABLE posts DROP FOREIGN KEY posts_ibfk_1');
    }
};
