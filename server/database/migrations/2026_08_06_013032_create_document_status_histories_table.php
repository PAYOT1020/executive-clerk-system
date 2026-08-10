<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_status_histories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('document_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('status');

            $table->text('remarks')->nullable();

            $table->foreignId('updated_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_status_histories');
    }
};
