<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRegionAndPagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = config('nova-page-manager.table', 'nova_page_manager');
        $regionsTableName = $tableName . '_regions';
        $pagesTableName = $tableName . '_pages';

        // Create pages table
        Schema::create($pagesTableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('slug')->default('')->unique();
            $table->string('template');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->json('data')->nullable();
        });

        // Create regions table
        Schema::create($regionsTableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('template');
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = config('nova-page-manager.table', 'nova_page_manager');
        $regionsTableName = $tableName . '_regions';
        $pagesTableName = $tableName . '_pages';

        Schema::dropIfExists($regionsTableName);
        Schema::dropIfExists($pagesTableName);
    }
}
