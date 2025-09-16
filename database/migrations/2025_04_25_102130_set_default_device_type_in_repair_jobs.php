<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('repair_jobs', function (Blueprint $table) {
            $table->string('device_type')->default('Unknown')->change();
        });
    }
    
    public function down()
    {
        Schema::table('repair_jobs', function (Blueprint $table) {
            $table->string('device_type')->nullable()->change();
        });
    }
    
};
