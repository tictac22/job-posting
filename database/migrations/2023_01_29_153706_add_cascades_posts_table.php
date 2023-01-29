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

		DB::statement('ALTER TABLE posts DROP INDEX posts_user_id_foreign;');
		Schema::table('posts', function ($table) {
			$table->unsignedInteger('user_id')
			->references('user_id')->on('users')
			->onUpdate('cascade')->onDelete('set null')->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		DB::statement('ALTER TABLE posts ADD FOREIGN KEY (posts_user_id_foreign) REFERENCES user(user_id);');
		Schema::table('posts', function ($table) {
			$table->unsignedInteger('user_id')->references('user_id')->on('user')->change();
		});
    }
};
