<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savings_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('savings_account_id')->constrained('savings_accounts')->cascadeOnDelete();
            $table->enum('trx_type', ['SETOR', 'TARIK']);
            $table->decimal('amount', 15, 2);
            $table->dateTime('trx_date');
            $table->string('ref_no')->unique();
            $table->string('description')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('savings_transactions');
    }
};
