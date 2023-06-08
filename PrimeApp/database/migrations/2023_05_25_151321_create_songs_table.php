<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('songname', 2000);
            $table->string('coverimage');
            $table->string('songimage');
            $table->string('songurl');
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('duration');
            $table->string('description');
            $table->foreignIdFor(User::class, 'create_by');
            $table->foreignIdFor(User::class, 'updated_by');
            $table->softDeletes();
            $table->foreignId(User::class, "deleted_by ")->nullable();
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
        Schema::dropIfExists('songs');
    }
}
