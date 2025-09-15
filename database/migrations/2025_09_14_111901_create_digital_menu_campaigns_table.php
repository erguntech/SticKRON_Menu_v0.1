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
        Schema::create('digital_menu_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->text('campaign_description')->nullable();
            $table->text('campaign_standard_price');
            $table->text('campaign_discounted_price');
            $table->integer('linked_client_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_menu_campaigns');
    }
};
