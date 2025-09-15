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
        Schema::create('digital_menu_contents', function (Blueprint $table) {
            $table->id();
            $table->string('content_name');
            $table->text('content_description')->nullable();
            $table->text('content_price');
            $table->integer('linked_digital_menu_category_id')->nullable();
            $table->integer('linked_client_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_menu_contents');
    }
};
