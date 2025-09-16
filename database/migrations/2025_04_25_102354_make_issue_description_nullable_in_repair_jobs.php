<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('repair_jobs', function (Blueprint $table) {
            $table->text('issue_description')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('repair_jobs', function (Blueprint $table) {
            $table->text('issue_description')->nullable(false)->change();
        });
    }
    
};
