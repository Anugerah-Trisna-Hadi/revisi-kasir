@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="text-align: center">
            <h1>Detail Transaksi</h1>
        </div>

        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $subtotal = 0 ?>
                @foreach ($checkout as $key => $value)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->nama_produk }}</td>
                        <td>Rp. {{ $value->harga }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>Rp. {{ $value->total }}</td>
                        <?php $subtotal += $value->total ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-center">Rp. {{ $subtotal }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection