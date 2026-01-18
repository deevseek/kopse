<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('saving_type_id')->constrained('saving_types');
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['member_id', 'saving_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('savings_accounts');
    }
};
