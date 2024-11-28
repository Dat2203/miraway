<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id(); // Trường id tự động tăng
            $table->string('serial'); // Trường serial
            $table->string('store_code'); // Mã cửa hàng
            $table->string('store_name'); // Tên cửa hàng
            $table->enum('status', ['active', 'inactive', 'pending']); // Trạng thái
            $table->enum('approval_status', ['approved', 'pending', 'rejected']); // Trạng thái phê duyệt
            $table->integer('counter')->default(0); // Bộ đếm
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};
