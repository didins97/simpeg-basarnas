<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jabatan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.mutasi.store') }}" method="POST" enctype="multipart/form-data" id="mutasiForm">
            @csrf
            <div class="form-group">
                <label for="pegawai">Pegawai</label>
                <select id="pegawai" class="form-control" name="pegawai_id" required>
                    @foreach ($pegawaiList as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kantorLama">Kantor Lama</label>
                <input type="text" class="form-control" id="kantorLama" placeholder="Masukkan Kantor Lama" name="kantor_lama" required>
            </div>
            <div class="form-group">
                <label for="kantorBaru">Kantor Baru</label>
                <input type="text" class="form-control" id="kantorBaru" placeholder="Masukkan Kantor Lama" name="kantor_baru" required>
            </div>
            <div class="form-group">
                <label for="unitKerjaLama">Unit Kerja / Departemen Lama</label>
                <input type="text" class="form-control" id="unitKerjaSebelum" placeholder="Masukkan Unit Kerja / Departemen" name="unit_kerja_sebelum" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Unit Kerja / Departemen Baru</label>
                <input type="text" class="form-control" id="unitKerjaBaru" placeholder="Masukkan Unit Kerja / Departemen" name="unit_kerja_baru" required>
            </div>
            <div class="form-group">
                <label for="tglMutasi">Tgl. Mutasi</label>
                <input type="date" class="form-control" id="tglMutasi" placeholder="Masukkan Tanggal Naik Jabatan" name="tgl_mutasi" required>
            </div>
            <div class="form-group">
                <label for="fileSk">File SK</label>
                <input type="file" class="form-control-file" id="fileSk" name="file_sk">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>
