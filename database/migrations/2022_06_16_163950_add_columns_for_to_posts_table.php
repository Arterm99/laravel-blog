<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('posts', function (Blueprint $table) {

            // (!) При доп. миграции строк обязательно указать ->nullable()
            $table->string('preview_image')->nullable();
            $table->string('main_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('preview_image');
        });

        // Для сразу двух удалений!!!!!!

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('main_image');
        });
    }
};
