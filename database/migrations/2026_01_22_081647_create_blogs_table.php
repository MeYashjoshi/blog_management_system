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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('slung');
            $table->string('featured_image')->nullable();
            $table->string('title');
            $table->text('content');
            $table->json('tags')->nullable();
            $table->date('published_at');
            $table->enum('status', ['0', '1', '2','3','4'])->default('0')->comment('0=Pending, 1=Active, 2=Inactive, 3=Draft, 4=Rejected');
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes

            //indexes
            $table->index('author_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
