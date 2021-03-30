<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();
        });

        
        // Trigger untuk mengurangi stok
        DB::unprepared('CREATE TRIGGER stokkurang AFTER INSERT ON carts FOR EACH ROW
        BEGIN 
            UPDATE produks SET stok=stok-NEW.jumlah
            WHERE id = NEW.id_produk;
        END ');

        // Trigger untuk gajadi dimasukkan cart
        DB::unprepared('CREATE TRIGGER stoktambah AFTER DELETE ON carts FOR EACH ROW
        BEGIN 
            UPDATE produks SET stok=stok+OLD.jumlah
            WHERE id = OLD.id_produk;
        END ');
        
        // Trigger untuk update cart nya
        DB::unprepared('CREATE TRIGGER stokupdate AFTER UPDATE ON carts FOR EACH ROW
        BEGIN 
            UPDATE produks SET stok=stok+OLD.jumlah-NEW.jumlah
            WHERE id = NEW.id_produk;
        END ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
