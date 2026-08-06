<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            'Invitation',
            'Cheque',
            'Program of Works',
            'Mayor Permit',
            'Purchase Order',
            'Purchase Request',
            'Bids and Awards Committee',
            'Notice of Award',
            'Requisition and Issuance Slip',
            'Petty Cash',
            'Endorsement',
            'Executive Order',
            'Memorandum of Understanding',
            'Memorandum of Agreement',

        ];

        foreach ($categories as $category) {

            DocumentCategory::create([
                'name' => $category,
                'is_active' => true,
            ]);

        }
    }
}
