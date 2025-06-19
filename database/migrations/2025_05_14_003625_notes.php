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
         if (!Schema::hasTable('notes')) {
            Schema::create('notes', function (Blueprint $table) {
                $table->id();
                $table->string('level');
                $table->string('module_name');
                $table->string('module_code'); 
                $table->decimal('coef_ct', 4, 2);
                $table->decimal('coef_ex', 4, 2);

                $table->string('student_code'); 
                $table->string('name');
                $table->string('last_name');
                $table->integer('note_ct');
                $table->integer('note_ex');
                $table->decimal('note_element', 4, 2);
                $table->string('professor_name');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
