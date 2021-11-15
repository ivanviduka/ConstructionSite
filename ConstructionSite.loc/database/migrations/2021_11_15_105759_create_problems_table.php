<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('picture_name');
            $table->string('apartment_area');
            $table->date('problem_recorded_date');
            $table->date('repairing_deadline_date');
            $table->text('description')->nullable();
            $table->boolean('is_repaired');
            $table->unsignedBigInteger("apartment_id")->index();
            $table->foreign("apartment_id")->references("id")->on("apartments")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
}
