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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string('email')->unique();
            $table->string("phone");
            $table->string('password');
            $table->unsignedBigInteger("agency_id")->nullable();
            $table->foreign("agency_id")->references("id")->on("agencies")->onDelete('cascade');
            $table->enum('role', [ 'admin', 'staff'])->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
