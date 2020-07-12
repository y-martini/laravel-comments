<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use YuriyMartini\Comments\Contracts\Comment;
use YuriyMartini\Comments\Contracts\Commentator;

class CreateCommentsTable extends Migration
{
    public function getTable()
    {
        /** @var Comment $comment */
        $comment = App::make(Comment::class);
        return $comment->getTable();
    }

    public function getCommentatorsTable()
    {
        /** @var Commentator $commentator */
        $commentator = App::make(Commentator::class);
        return $commentator->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('commentator_id');
            $table->morphs('commentable');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('text')->nullable();

            $table
                ->foreign('commentator_id')
                ->references('id')
                ->on($this->getCommentatorsTable());
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on($this->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
