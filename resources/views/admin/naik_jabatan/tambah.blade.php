<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jabatan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.promosi.store') }}" method="POST" enctype="multipart/form-data" id="jabatanForm">
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
                <label for="jabatan">Jabatan / Golongan Lama</label>
                <input type="text" class="form-control" id="jabatanLama" placeholder="Masukkan Jabatan" name="jabatan_sebelum" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan / Golongan Baru</label>
                <input type="text" class="form-control" id="jabatanBaru" placeholder="Masukkan Jabatan" name="jabatan_baru" required>
            </div>
            <div class="form-group">
                <label for="tglNaik">Tgl. Naik Jabatan</label>
                <input type="date" class="form-control" id="tglNaik" placeholder="Masukkan Tanggal Naik Jabatan" name="tgl_promosi" required>
            </div>
            <div class="form-group">
                <label for="fileSk">File SK</label>
                <input type="file" class="form-control-file" id="fileSk" name="file_sk">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>
