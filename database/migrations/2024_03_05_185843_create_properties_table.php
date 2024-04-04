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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->integer("area");
            $table->decimal("price", 10)->default(0);
            $table->string("type")->default("For Sale");
            $table->integer("floors")->nullable();
            $table->integer("rooms")->default(1);
            $table->integer("bathrooms")->nullable();
            $table->boolean("featured")->default(false);
            $table->boolean("active")->default(true);
            $table->foreignId("category_id")->constrained("categories");
            $table->foreignId("address_id")->constrained("addresses");
            $table->foreignId("heating_id")->constrained("heatings");
            $table->foreignId('seller_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
