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
        Schema::create('form_builders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('caption');
            $table->enum('type', ['Event', 'Activity']);
            $table->enum('position', ['in-port', 'in-filed','in-transit']);
            $table->enum('rob', ['0','1']);
            $table->JSON('asset_type');
            $table->JSON('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_builders');
    }
};
