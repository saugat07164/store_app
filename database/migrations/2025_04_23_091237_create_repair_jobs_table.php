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
        Schema::create('repair_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->cascadeOnDelete()
                  ->index()
                  ->name('fk_repairs_customer_id');
            $table->string('device_type');
            $table->string('device_brand');
            $table->text('issue_description');
            $table->enum('status', ['pending', 'in_progress', 'awaiting_parts', 'completed', 'cancelled'])
                  ->default('pending');
            $table->datetime('repair_date');
            $table->datetime('completion_date')->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_jobs');
    }
};
