<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('project_id')->constrained('projects','id')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('departments','id')->cascadeOnDelete();  
            $table->enum('type',['0','1','2'])->comment('0=>main , 1=>branch ,2=>subbranch');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('isComment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
