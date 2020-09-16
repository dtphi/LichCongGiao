<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id')->comment('会員ID');
            $table->string('name_kana', 30)->comment('名前カナ');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('organization_id')->comment('組織 ID');
            $table->tinyInteger('type')->comment('organization_idの値によって決定される');
            $table->bigInteger('base_id')->nullable();
            $table->tinyInteger('status')->comment('ステータス');
            $table->timestamp('last_login_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
