<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
//        Schema::table('goals', function (Blueprint $table) {
//            $table->string('title')->after('user_id');
//            $table->decimal('current_amount', 10, 2)->default(0)->after('target_amount');
//            $table->date('due_date')->after('description');
//        });
    }

    public function down()
    {
//        Schema::table('goals', function (Blueprint $table) {
//            $table->dropColumn(['title', 'current_amount', 'due_date']);
//        });
    }
};
