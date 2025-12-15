<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('news', function (Blueprint $table) {
        // --- SỬA DÒNG NÀY ---
        // Thay vì $table->id(); hãy dùng:
        $table->bigIncrements('id'); 
        // --------------------

        $table->string('title'); 
        $table->string('slug')->unique(); 
        $table->text('summary')->nullable(); 
        $table->longText('content'); 
        $table->string('thumbnail')->nullable(); 
        
        // Lưu ý: Nếu bảng users của bạn dùng id là 'increments' (int thường) 
        // thì dòng dưới sửa thành: $table->integer('author_id')->unsigned();
        $table->unsignedBigInteger('author_id'); 
        
        $table->tinyInteger('status')->default(0); 
        $table->timestamp('published_at')->nullable(); 
        $table->timestamps();
        
        // $table->foreign('author_id')->references('id')->on('users');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
