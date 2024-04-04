<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("street");
            $table->string("number");
            $table->foreignId("city_id")->constrained("cities");
            $table->foreignId("country_id")->constrained("countries");
            $table->timestamps();
        });
    }
    /**
    Schema::create('properties', function (Blueprint $table) {
    $table->id();
    $table->string("title");
    $table->string("description");
    $table->string("area");
    $table->binary("type");
    $table->string("heating");
    $table->integer("floors")->nullable();
    $table->integer("rooms")->default(1);
    $table->integer("bathrooms")->nullable();
    $table->boolean("featured")->default(false);
    $table->foreignId("category_id")->constrained("categories");
    $table->foreignId("address_id")->constrained("address");
    $table->timestamps();
    });
     * */


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
