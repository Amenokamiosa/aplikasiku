<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_tree', function (Blueprint $table) {

            $table->id();

            $table->Integer('id_event');
            $table->Integer('id_tree');

            $table->foreign('id_event')
                ->references('id_event')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('id_tree')
                ->references('id_tree')
                ->on('trees')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_tree');
    }
};