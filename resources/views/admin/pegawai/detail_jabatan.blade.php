<!-- Modal -->
<div class="modal fade" id="modalJab" tabindex="-1" role="dialog" aria-labelledby="modalJabLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJabLabel">Riwayat Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jabatan Lama</th>
                            <th>Jabatan Baru</th>
                            <th>Tanggal Promosi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai->riwayatJabatan as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->jabatan_sebelum }}</td>
                            <td>{{ $item->jabatan_baru }}</td>
                            <td>{{ $item->tgl_promosi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
