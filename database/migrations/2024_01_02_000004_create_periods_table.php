<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->timestamps();
        });

        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE periods ADD COLUMN active_guard TINYINT GENERATED ALWAYS AS (CASE WHEN is_active = 1 THEN 1 ELSE NULL END) STORED');
            DB::statement('CREATE UNIQUE INDEX periods_active_unique ON periods (active_guard)');
        } elseif ($driver === 'pgsql') {
            DB::statement('CREATE UNIQUE INDEX periods_active_unique ON periods ((CASE WHEN is_active THEN 1 ELSE NULL END))');
        } else {
            DB::statement('CREATE UNIQUE INDEX periods_active_unique ON periods(is_active) WHERE is_active = 1');
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('DROP INDEX periods_active_unique ON periods');
            DB::statement('ALTER TABLE periods DROP COLUMN active_guard');
        } else {
            DB::statement('DROP INDEX periods_active_unique');
        }

        Schema::dropIfExists('periods');
    }
};
