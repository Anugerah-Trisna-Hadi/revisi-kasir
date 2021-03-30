<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Produk;
use Livewire\Component;

class Produks extends Component
{
    // untuk fungsi endpoint post/insert ke database
    public $nama, $total_bayar, $kembalian;

    // $jb = jumlah barang yang mau dimasukkan cart
    // $tharga = total harga
    public $jb, $produk, $tharga, $bayar, $cart;

    public function mount()
    {
        // menghapus semua id yang lebih dari 0
        Cart::where('id', '>', 0)->delete();
    }

    public function render()
    {
        $produk = Produk::all();
        $th = 0;
        foreach ($produk as $key => $value) {
            // mengecek data yang di inputan Beli
            if (isset($this->jb[$value->id])) {
                // mengecek apabila lebih dari 0, maka dieksekusi
                if ($this->jb[$value->id] >= 0) {
                    // menambah total harga
                    $th += $this->jb[$value->id] * $value->harga;
                    //buat ngisi cart
                    Cart::updateOrInsert(
                        ['id_produk' => $value->id],
                        [
                            'nama_produk' => $value->nama,
                            'harga' => $value->harga,
                            'jumlah' => $this->jb[$value->id],
                            'total' => $value->harga * $this->jb[$value->id],
                        ]
                    );
                }
            }
        }
        // set data ke public biar bisa dipanggil di view livewire
        $this->kembalian = $this->total_bayar - $this->tharga;
        $this->cart = Cart::all();
        $this->produk = Produk::all();
        $this->tharga = $th;
        return view('livewire.produk');
    }

    // Fungsi untuk menambahkan ke database
    public function store()
    {
        Transaction::insert([
            'total_harga' => $this->tharga,
            'total_bayar' => $this->total_bayar
        ]);

        // fungsi untuk mengurangi stok
        foreach ($this->cart as $key => $value) {
            Produk::where('id', $value['id'])->update([
                'stok' => $value['stok'] - $value['jumlah']
            ]);
        }

        $this->nama = NULL;
        $this->total_bayar = NULL;
        $this->jb = NULL;
        $this->tharga = NULL;
        $this->bayar = NULL;
        $this->cart = NULL;

        return redirect('checkout');
    }

    // fungsi untuk menghapus cart
    public function hapuscart($id)
    {
        $this->jb[$id] = NULL;
        Cart::where('id_produk', $id)->delete();
    }
}
