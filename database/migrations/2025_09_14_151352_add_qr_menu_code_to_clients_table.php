<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'qr_menu_code')) {
                $table->string('qr_menu_code', 8)->unique()->nullable()->after('qr_menu_content');
            }
        });
    }

    public function down(): void {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'qr_menu_code')) {
                $table->dropColumn('qr_menu_code');
            }
        });
    }
};
