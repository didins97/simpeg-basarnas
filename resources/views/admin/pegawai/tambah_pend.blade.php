<div class="modal fade" id="modalPend" tabindex="-1" role="dialog" aria-labelledby="modalPendLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.pegawai.upload', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPendLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NamaDokumen">Keterangan Dokumen</label>
                        <input type="text" class="form-control" id="nama"
                            placeholder="cth: Sertifikat Pelatihan D3 / Ijazah SMK " name="nama_dokumen" required>
                    </div>
                    <div class="form-group">
                        <label for="jenisDokumen">Jenis Dokumen</label>
                        <select id="jenisDokumen" class="form-control" name="jenis_dokumen" required>
                            <option value="sertifikat">Sertifikat</option>
                            <option value="ijazah">Ijazah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File / Dokumen</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
