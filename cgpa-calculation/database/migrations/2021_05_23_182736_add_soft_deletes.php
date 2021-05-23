<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_datas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('subjects', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('regulations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('subject_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('marks_data', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_datas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('regulations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('subject_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('marks_data', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
