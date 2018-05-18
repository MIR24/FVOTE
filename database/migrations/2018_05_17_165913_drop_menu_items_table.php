<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('menu_items');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->smallInteger('position')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->string('path', 255)->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->integer('level')->default(0);
            $table->boolean('admin_section')->default(false);
            $table->index(['path', 'parent_id', 'level']);
        });
        $sql = "REPLACE INTO `menu_items`(`id`,`created_at`,`updated_at`,`deleted_at`,`position`,`name`,`url`,`icon`,`path`,`parent_id`,`level`,`admin_section`) VALUES 
( '1', '2018-05-15 17:49:24', '2018-05-15 17:49:24', NULL, NULL, 'Меню', NULL, NULL, '1/', NULL, '0', '0' ),
( '2', '2018-05-15 17:49:24', '2018-05-15 17:49:24', NULL, NULL, 'Пользователи', NULL, 'flaticon-user', '1/2/', '1', '1', '0' ),
( '3', '2018-05-15 17:49:24', '2018-05-15 17:49:24', NULL, NULL, 'Номинации', NULL, 'flaticon-list-2', '1/3/', '1', '1', '0' );";
        DB::connection()->getPdo()->exec($sql);
    }
}
