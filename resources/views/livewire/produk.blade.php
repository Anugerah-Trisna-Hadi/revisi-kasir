<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-white">Pilih Barang</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok tersisa</th>
                                <th>beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $value)
                                <tr>
                                    <td> {{ $value->nama }} </td>
                                    <td> {{ $value->harga }} </td>
                                    <td> {{ $value->stok }} </td>
                                    <td>
                                        <input class="form-control" type="number" wire:model='jb.{{ $value->id }}'
                                            min="0" max="{{ $value->maxjb }}" placeholder="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">Pembayaran</div>

                <div class="card-body">
                    <form wire:submit.prevent="store">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Harga</label>

                            <div class="input-group col-sm-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="" value="{{ $tharga }}"
                                    placeholder="0" readonly required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Bayar</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input wire:model="total_bayar" type="number" class="form-control" name=""
                                    min="{{ $tharga }}" placeholder="0" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kembalian</label>
                            <div class="input-group col-sm-10">
                                <input class="form-control" type="text" value="@if ($kembalian>
                            0) {{ $kembalian }} @else isi total bayar @endif "
                                readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Bayar</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">Cart</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-primarry">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($cart)
                                @foreach ($cart as $key => $value)
                                    <tr>
                                        <td> {{ $value->nama_produk }} </td>
                                        <td> {{ $value->harga }} </td>
                                        <td> {{ $value->jumlah }} </td>
                                        <td> {{ $value->total }} </td>
                                        <td>
                                            <button wire:click='hapuscart({{ $value->id_produk }})'
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">TOTAL SEMUA</td>
                                    <td>{{ $tharga }}</td>
                                    <td></td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
