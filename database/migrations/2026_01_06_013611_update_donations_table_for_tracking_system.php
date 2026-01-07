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
        Schema::table('donations', function (Blueprint $table) {
            $table->string('tracking_code', 20)->unique()->after('id');
            $table->foreignId('tree_type_id')->nullable()->after('donor_email')->constrained('pohons')->onDelete('cascade');
            $table->string('location_detail', 200)->nullable()->after('location');
            $table->date('plant_date')->nullable()->after('program');
            $table->decimal('latitude', 10, 8)->nullable()->after('plant_date');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('health_status', 50)->default('Sangat Baik')->after('longitude');
            $table->integer('growth_progress')->default(0)->after('health_status');
            
            // Rename kolom lama
            $table->renameColumn('price_per_tree', 'amount');
            
            // Hapus kolom yang tidak dipakai
            $table->dropColumn(['total_price', 'tree_type']);
            
            // Tambah index untuk optimasi
            $table->index('tracking_code');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Kembalikan seperti semula jika rollback
            $table->dropColumn([
                'tracking_code',
                'tree_type_id',
                'location_detail',
                'plant_date',
                'latitude',
                'longitude',
                'health_status',
                'growth_progress'
            ]);
            
            $table->renameColumn('amount', 'price_per_tree');
            $table->decimal('total_price', 15, 2)->after('price_per_tree');
            $table->string('tree_type')->after('program');
        });
    }
};