<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->bigIncrements('info_id');
            $table->tinyInteger('type')->nullable()->comment('お知らせ対象');
            $table->bigInteger('base_id')->comment('事務局ID');
            $table->string('info_title', 100)->comment('お知らせタイトル');
            $table->text('info_contents', 500)->comment('お知らせ内容');
            $table->timestamp('disp_start_date')->comment('公開開始日');
            $table->timestamp('disp_end_date')->nullable()->comment('公開終了日');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'))->comment('作成日');
            $table->timestamp('updated_at')->nullable()->comment('更新日');
            $table->softDeletes()->nullable()->comment('削除日(削除フラグ)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informations');
    }
}
