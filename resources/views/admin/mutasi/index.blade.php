@extends('app')

@section('title', 'Data Mutasi')

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
                    <table id="mutasiTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kantor & Unit Lama</th>
                                <th>Kantor & Unit Baru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mutasiList as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai->nama }}</td>
                                    <td>{{ $item->unit_kerja_sebelum }} ({{$item->kantor_lama}})</td>
                                    <td>{{ $item->unit_kerja_baru}} ({{$item->kantor_baru}})</td>
                                    <td class="project-actions text-right">
                                        {{-- <a class="btn btn-primary btn-sm" href="{{ route('admin.mutasi.show.file', $item->id) }}" target="_blank">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                        <a class="btn btn-info btn-sm btn-edit" href="#" data-id="{{$item->id}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm btn-delete" href="#" data-id="{{$item->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                        <a class="dropdown" type="button" id="dropdownMenu1" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.mutasi.show.file', $item->id) }}">Lihat SK</a></li>
                                            <li><a class="dropdown-item btn-edit" href="javascript:void(0)" data-id="{{$item->id}}">Edit</a></li>
                                            <li><a class="dropdown-item btn-delete" href="javascript:void(0)" data-id="{{ $item->id }}">Hapus</a></li>
                                        </ul>
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
            @include('admin.mutasi.tambah')
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
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // datatables
        $(function () {
            $("#mutasiTable").DataTable({
                "dom": 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3],
                        },
                    },
                ]
            })
        })

        // tombol edit
        $('.btn-edit').on('click', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "/mutasi/" + id + "/edit",
                type: "GET",
                success: function (response) {
                    // add value
                    $('#pegawai').val(response.pegawai.id);
                    // $('#pegawai').html(response.pegawai.nama);
                    $('#tglMutasi').val(response.tgl_mutasi);
                    $('#unitKerjaSebelum').val(response.unit_kerja_sebelum);
                    $('#unitKerjaBaru').val(response.unit_kerja_baru);
                    $('#kantorLama').val(response.kantor_lama);
                    $('#kantorBaru').val(response.kantor_baru);
                    $('#mutasiForm').attr('action', `/mutasi/${response.id}`);
                    $('#mutasiForm').append('<input type="hidden" name="_method" value="PUT">');
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
                        url: `/mutasi/${id}`,
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
