@extends('app')

@section('title', 'Grafik Analisis Mixture')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Pilih Atribut untuk Analisis</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.analysis.store') }}">
                    @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="usia" checked>
                        <label class="form-check-label" for="usia">
                            Usia
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="pend_terakhir">
                        <label class="form-check-label" for="pendidikan">
                            Pendidikan
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="lama_kerja" checked>
                        <label class="form-check-label" for="lama_kerja">
                            Lama Kerja
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="jabatan">
                        <label class="form-check-label" for="jabatan">
                            Jabatan
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="unit_kerja">
                        <label class="form-check-label" for="unit_kerja">
                            Unit Kerja
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="attributes[]" value="jns_kelamin">
                        <label class="form-check-label" for="jenis_kelamin">
                            Jenis Kelamin
                        </label>
                    </div>
                    <div class="form-group mt-2">
                        <label for="k">Jumlah Klaster</label>
                        <input type="number" class="form-control" id="k" name="k" min="1" max="9" required placeholder="Masukkan K (1-9)">
                    </div>
                    <div class="form-group">
                        <label for="maxIteration">Max Iteration</label>
                        <input type="number" class="form-control" id="maxIteration" name="maxIteration" min="1" max="100" required placeholder="Masukkan Max Iteration (1-100)">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Analisis</button>
                </form>
            </div>
        </div>
    </div>
@endsection
