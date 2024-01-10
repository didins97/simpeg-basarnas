@extends('app')

@section('title', 'Data Jabatan')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="jabatanTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan Lama</th>
                                <th>Jabatan Baru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatanList as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai->nama }}</td>
                                    <td>{{ $item->jabatan_sebelum }}</td>
                                    <td>{{ $item->jabatan_baru }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.promosi.show.file', $item->id) }}" target="_blank">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                        <a class="btn btn-info btn-sm btn-edit" href="#" data-id="{{$item->id}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm btn-delete" href="#" data-id="{{$item->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
            @include('admin.naik_jabatan.tambah')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // datatables
        $(function () {
            $("#jabatanTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            })
        })

        // tombol edit
        $('.btn-edit').on('click', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "/promosi/" + id + "/edit",
                type: "GET",
                success: function (response) {
                    // add value
                    $('#pegawai').val(response.pegawai.id);
                    // $('#pegawai').html(response.pegawai.nama);
                    $('#tglNaik').val(response.tgl_promosi);
                    $('#jabatanLama').val(response.jabatan_sebelum);
                    $('#jabatanBaru').val(response.jabatan_baru);
                    $('#jabatanForm').attr('action', `/promosi/${response.id}`);
                    $('#jabatanForm').append('<input type="hidden" name="_method" value="PUT">');
                }
            });
        })

        // tombol delete
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apa anda yakin untuk menghapus ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777ef',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/promosi/${id}`,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire("Done!", response.message, "success");
                                location.reload();
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        }
                    });
                }
            })
        })
    </script>
@endpush
