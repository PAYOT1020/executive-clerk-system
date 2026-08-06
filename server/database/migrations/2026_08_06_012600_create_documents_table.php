<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_number')->unique();

            $table->foreignId('category_id')
                ->constrained('document_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('subject');
            $table->string('sender');
            $table->date('date_received');

            $table->enum('current_status', [
                'received',
                'checking',
                'for_signature',
                'signed',
                'released',
                'archived'
            ])->default('received');

            $table->enum('lifecycle_status', [
            'active',
            'completed',
            'archived'
            ])->default('active');

            $table->foreignId('received_by')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
