<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToBookOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'status')) {
			Schema::table('orders', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->comment('1: new, 2: in progress, 3: delivered')
                ->after('description');
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
        if (Schema::hasColumn('orders', 'status')) {
			Schema::table('orders', function (Blueprint $table) {
				$table->dropColumn('status');
			});
		}
    }
}
