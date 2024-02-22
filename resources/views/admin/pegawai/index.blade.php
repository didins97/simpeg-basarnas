@extends('app')

@section('title', 'Data Pegawai')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jns_kelamin }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>
                                    {{-- @if ($item->status_pegawai == 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif --}}
                                    @switch($item->jenis_pegawai)
                                        @case('PNS')
                                            <span class="badge badge-success">PNS</span>
                                            @break
                                        @case('Kontrak')
                                            <span class="badge badge-info">Kontrak</span>
                                            @break
                                        @case('Lainnya')
                                            <span class="badge badge-warning">Lainnya</span>
                                            @break
                                        @default
                                    @endswitch
                                </td>
                                {{-- <td>{{\Carbon\Carbon::parse($item->tanggal_masuk)->format('Y')}}</td> --}}
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.pegawai.show', $item->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                    <a class="btn btn-info btn-sm btn-edit" href="#" data-id="{{$item->id}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-delete" href="#" data-id="{{$item->id}}">
                                        <i class="fas fa-trash">
                                        </i>
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
@endsection

@section('modal')
    @include('admin.pegawai.tambah')
    @include('admin.pegawai.edit')
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        text: '<i class="fas fa-plus"></i> Tambah',
                        className: 'btn btn-tambah',
                        action: function(e, dt, node, config) {
                            $('#myModal').modal('show');
                        }
                    }
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $('.btn-edit').click(function (e) {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                type: "GET",
                url: `/pegawai/${id}/edit`,
                success: function (response) {
                    $('#nipEdit').val(response.nip);
                    $('#namaLengkapEdit').val(response.nama);
                    $('#jenisKelaminEdit').val(response.jns_kelamin);
                    $('#tempatLahirEdit').val(response.t_lahir);
                    $('#tanggalLahirEdit').val(response.tgl_lahir);
                    $('#agamaEdit').val(response.agama);
                    $('#statusPernikahanEdit').val(response.status_maritai);
                    $('#alamatRumahEdit').val(response.alamat);
                    $('#alamatEmailEdit').val(response.email);
                    $('#nomorTeleponEdit').val(response.nohp);
                    $('#jabatanEdit').val(response.jabatan);
                    $('#departemenEdit').val(response.unit_kerja);
                    $('#tanggalMulaiBekerjaEdit').val(response.tanggal_masuk);
                    $('#pendidikanTerakhirEdit').val(response.pend_terakhir);
                    $('#namaInstitusiEdit').val(response.nama_institut);
                    $('#jurusanStudiEdit').val(response.jurusan);
                    $('#tahunLulusEdit').val(response.tahun_lulus);
                    $('#statusPegawaiEdit').val(response.jenis_pegawai);
                    $('#pegawaiFormEdit').attr('action', `/pegawai/${response.id}`);
                }
            });
            $('#editModal').modal('show');
        });

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
                        url: `/pegawai/${id}`,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(results) {
                            if (results.success === true) {
                                Swal.fire("Done!", results.message, "success");
                                location.reload();
                            } else {
                                Swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                }
            })
        })

        var form = 1;
        $('.btn-multiple').click(function (e) {
            form++;
            console.log(form);
            var objTo = document.getElementById('dynamicForm');
            var divTest = document.createElement('div');
            divTest.setAttribute('class', 'form-row upload-file'+form);
            divTest.innerHTML = `
            <div class="form-group col">
                                    <label for="jurusanStudi">Jenis File</label>
                                    <select name="jenis_file[]" id="jnsFile" class="form-control">
                                        <option value="sertifikat">Sertifikat</option>
                                        <option value="ijazah">Ijazah</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control-file" id="file" name="file[]"
                                        required>
                                </div>
                                <div class="form-group col">
                                    <label for="file">Judul File</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control rounded-0" name="judul_file[]">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-flat btn-remove"><i class="fas fa-minus"></i></button>
                                        </span>
                                    </div>
                                </div>
            `
            objTo.appendChild(divTest);
        });

        $(document).on('click', '.btn-remove', function () {
            $(this).closest('.form-row').remove();
        })
    </script>
@endpush
