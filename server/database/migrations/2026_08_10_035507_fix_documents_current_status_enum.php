<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE documents MODIFY current_status ENUM(
            'received',
            'checking',
            'for_signature',
            'signed',
            'released',
            'archived'
        ) NOT NULL DEFAULT 'received'");
    }

    public function down(): void
    {
        // Adjust to whatever the previous (broken) enum list was, if you need rollback support
        DB::statement("ALTER TABLE documents MODIFY current_status ENUM(
            'received',
            'checking',
            'for_signature',
            'signed',
            'released',
            'archived'
        ) NOT NULL DEFAULT 'received'");
    }
};
