<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskPriceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_price_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ask_price_id')->constrained();
            $table->string('partname', 100);
            $table->string('machine', 100);
            $table->char('quality', 1);
            $table->smallInteger('qty');
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
        Schema::dropIfExists('ask_price_lines');
    }
}
