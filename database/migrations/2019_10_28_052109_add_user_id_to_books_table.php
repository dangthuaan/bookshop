<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasColumn('books', 'user_id')) {
			Schema::table('books', function (Blueprint $table) {
				$table->bigInteger('user_id')->after('price');
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('books', 'user_id')) {
			Schema::table('books', function (Blueprint $table) {
				$table->dropColumn('user_id');
			});
		}
    }
}
