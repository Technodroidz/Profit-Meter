<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\User;
// use Config;
class CreateBusinessCustomCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        //     $users = User::get();
        //     foreach ($users as $key => $value) {
        //         if(!empty($value->database_name)){
        //             if (!Schema::connection($value->database_name)->hasTable('business_custom_costs')) {
        //                 Config::set("database.connections.".$value->database_name, [
        //                     'driver' => 'mysql',
        //                     'url' => env('DATABASE_URL'),
        //                     'host' => env('DB_HOST', '127.0.0.1'),
        //                     'port' => env('DB_PORT', '3306'),
        //                     'database' =>$value->database_name,
        //                     'username' => env('DB_USERNAME', 'forge'),
        //                     'password' => env('DB_PASSWORD', ''),
        //                     'unix_socket' => env('DB_SOCKET', ''),
        //                     'charset' => 'utf8mb4',
        //                     'collation' => 'utf8mb4_unicode_ci',
        //                     'prefix' => '',
        //                     'prefix_indexes' => true,
        //                     'strict' => true,
        //                     'engine' => null,
        //                     'options' => extension_loaded('pdo_mysql') ? array_filter([
        //                     PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        //                     ]) : []
        //                 ]);
        //                 Schema::connection($value->database_name)->create('business_custom_costs', function (Blueprint $table) {
        //                     $table->increments('id');
        //                     $table->string('custom_name')->nullable();
        //                     $table->string('custom_slug')->nullable();
        //                     $table->unsignedInteger('category_id')->nullable();
        //                     $table->foreign('category_id')->references('id')->on('business_categories'); 
        //                     $table->string('start_date')->nullable();
        //                     $table->string('end_date')->nullable();
        //                     $table->string('frequency')->nullable();
        //                     $table->string('cost')->nullable();
        //                     $table->integer('accept_include_marketing')->nullable();
        //                     $table->softDeletes();
        //                     $table->timestamps();
        //          });
        //     }

        // }

     //}


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_custom_costs');
    }
}
