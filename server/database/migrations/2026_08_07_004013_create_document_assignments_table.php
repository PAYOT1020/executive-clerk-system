    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {

        public function up(): void
    {
        Schema::create('document_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_id')
                ->constrained('documents')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assigned_to')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('document_assignments');
        }
    };
