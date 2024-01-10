<!-- Modal -->
<div class="modal fade" id="modalMut" tabindex="-1" role="dialog" aria-labelledby="modalMutLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMutLabel">Riwayat Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unit Lama</th>
                            <th>Unit Baru</th>
                            <th>Tanggal Promosi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai->riwayatMutasi as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->unit_kerja_sebelum }}</td>
                            <td>{{ $item->unit_kerja_baru }}</td>
                            <td>{{ $item->tgl_mutasi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
