<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add mobile fields if they don't exist
            if (!Schema::hasColumn('users', 'mobile')) {
                $table->string('mobile')->nullable()->unique()->after('password');
            }
            if (!Schema::hasColumn('users', 'mobile_verified')) {
                $table->boolean('mobile_verified')->default(false)->after('mobile');
            }
            if (!Schema::hasColumn('users', 'registration_method')) {
                $table->enum('registration_method', ['email', 'phone'])->default('email')->after('mobile_verified');
            }
            
            // Add new verification fields
            if (!Schema::hasColumn('users', 'is_mobile_verified')) {
                $table->boolean('is_mobile_verified')->default(false)->after('registration_method');
            }
            if (!Schema::hasColumn('users', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('is_mobile_verified');
            }
            if (!Schema::hasColumn('users', 'verification_step')) {
                $table->string('verification_step')->nullable()->after('is_verified');
            }
        });

        // Update existing data
        DB::table('users')->update([
            'is_email_verified' => DB::raw('CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END'),
            'is_mobile_verified' => DB::raw('COALESCE(mobile_verified, 0)'),
            'is_verified' => DB::raw('CASE WHEN email_verified_at IS NOT NULL OR mobile_verified = 1 OR google_id IS NOT NULL OR facebook_id IS NOT NULL THEN 1 ELSE 0 END'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'mobile_verified', 'registration_method', 'is_mobile_verified', 'is_verified', 'verification_step']);
        });
    }
};
