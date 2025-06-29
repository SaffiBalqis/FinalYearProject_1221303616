<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('forum_posts', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }
    
    public function down()
    {
        Schema::table('forum_posts', function (Blueprint $table) {
            $table->dropTimestamps(); // Drops created_at and updated_at columns
        });
    }
    
};
