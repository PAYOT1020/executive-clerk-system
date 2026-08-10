<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Temporarily allow both the old and new statuses
        DB::statement("
            ALTER TABLE documents
            MODIFY current_status ENUM(
                'received',
                'checking',
                'under_review',
                'for_signature',
                'released',
                'archived'
            ) NOT NULL DEFAULT 'received'
        ");

        // Step 2: Convert existing records
        DB::table('documents')
            ->where('current_status', 'checking')
            ->update([
                'current_status' => 'under_review',
            ]);

        // Step 3: Remove the old 'checking' status
        DB::statement("
            ALTER TABLE documents
            MODIFY current_status ENUM(
                'received',
                'under_review',
                'for_signature',
                'released',
                'archived'
            ) NOT NULL DEFAULT 'received'
        ");
    }

    public function down(): void
    {
        // Temporarily allow both statuses again
        DB::statement("
            ALTER TABLE documents
            MODIFY current_status ENUM(
                'received',
                'checking',
                'under_review',
                'for_signature',
                'released',
                'archived'
            ) NOT NULL DEFAULT 'received'
        ");

        // Convert the new status back to the old status
        DB::table('documents')
            ->where('current_status', 'under_review')
            ->update([
                'current_status' => 'checking',
            ]);

        // Restore the original ENUM
        DB::statement("
            ALTER TABLE documents
            MODIFY current_status ENUM(
                'received',
                'checking',
                'for_signature',
                'released',
                'archived'
            ) NOT NULL DEFAULT 'received'
        ");
    }
};
