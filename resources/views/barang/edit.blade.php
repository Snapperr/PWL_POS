@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($barang)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                The requested data was not found.
            </div>
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Back</a>
        @else
            <form method="POST" action="{{ url('/barang/'.$barang->barang_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Barang Code</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="barang_kode" name="barang_kode" value="{{ old('barang_kode', $barang->barang_kode) }}" required>
                        @error('barang_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Barang Name</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="barang_nama" name="barang_nama" value="{{ old('barang_nama', $barang->barang_nama) }}" required>
                        @error('barang_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Category</label>
                    <div class="col-10">
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Purchase Price</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                        @error('harga_beli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Selling Price</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                        @error('harga_jual')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}">Back</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush