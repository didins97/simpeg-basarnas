@extends('app')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow mb-4 align-middle">
                    <div class="card-body ">
                        <img src="{{ asset('storage/foto/'.$pegawai->foto) }}" alt="User profile picture" width="190px" height="190px" max-height="190px">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">
                            {{ $pegawai->nama }}({{ $pegawai->jabatan }})</h6>
                    </div>
                    <div class="card-body">
                        <i class="fa fa-address-card"></i> {{ $pegawai->nip }}
                        <hr>
                        <i class="fa fa-phone"></i> {{ $pegawai->nohp }}
                        <hr>
                        <i class="fa fa-envelope"></i> {{ $pegawai->email }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4 p-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">Riwayat Jabatan & Mutasi</h6>
                    </div>
                    <div class="card-body">
                        <b>Riwayat Jabatan</b> <a class="float-right">
                            <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalJab"><i
                                    class="fa fa-eye"></i></button>
                        </a>
                        <hr>
                        <b>Riwayat Mutasi</b> <a class="float-right">
                            <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalMut"><i
                                    class="fa fa-eye"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">Informasi Pribadi</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">Alamat</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Pendidikan</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="col-md-12">
                            <div class="card shadow mb-4 pl-5 pt-5 pr-5">
                                <!-- row 1 -->
                                <div class="row">
                                    <div class="col-md-4"> NIP / IDCARD
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->nip }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 2 -->
                                <div class="row">
                                    <div class="col-md-4"> Nama
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->nama }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 3 -->
                                <div class="row">
                                    <div class="col-md-4"> Tempat, Tanggal Lahir
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->t_lahir }}, {{ $pegawai->tgl_lahir }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 4 -->
                                <div class="row">
                                    <div class="col-md-4"> Agama
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->agama }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 5 -->
                                <div class="row">
                                    <div class="col-md-4"> Jenis Kelamin
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->jns_kelamin }} </div>
                                </div>
                                <hr>
                                <!-- row 7 -->
                                <div class="row">
                                    <div class="col-md-4"> Status Pernikahan
                                    </div>
                                    <div class="col-md-8"> : @switch($pegawai->status_maritai)
                                            @case('belum_menikah')
                                                Belum Menikah
                                            @break

                                            @case('menikah')
                                                Menikah
                                            @break

                                            @case('janda_duda')
                                                @if ($pegawai->jns_kelamin == 'pria')
                                                    DUDA
                                                @else
                                                    Janda
                                                @endif
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                </div>
                                <hr>
                                <!-- row 8 -->
                                <div class="row">
                                    <div class="col-md-4"> Status Kepegawaian
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->status_pegawai == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    </div>
                                </div>
                                <hr>
                                <!-- card shadow -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <div class="col-md-12">
                            <div class="card shadow mb-4 pl-5 pt-5 pr-5">
                                <!-- row 1 -->
                                <div class="row">
                                    <div class="col-md-4"> Kota Asal
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->alamat }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 1 -->
                                <div class="row">
                                    <div class="col-md-4"> Alamat
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->alamat }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 2 -->
                                <div class="row">
                                    <div class="col-md-4"> Email
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->email }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 10 -->
                                <div class="row">
                                    <div class="col-md-4"> No. Telp
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->nohp }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="col-md-12">
                            <div class="card shadow mb-4 p-3">
                                <!-- row 1 -->
                                <div class="row">
                                    <div class="col-md-4"> Pendidikan Terakhir
                                    </div>
                                    <div class="col-md-8"> : <span
                                            class="badge badge-primary">{{ $pegawai->pend_terakhir }}</span> </div>
                                </div>
                                <hr>
                                <!-- row 2 -->
                                <div class="row">
                                    <div class="col-md-4"> Nama Sekolah / Institut
                                    </div>
                                    <div class="col-md-8"> : {{ $pegawai->nama_institut }}
                                    </div>
                                </div>
                                <hr>
                                <!-- row 3 -->
                                <div class="row">
                                    <div class="col-md-4"> Tahun Kelulusan
                                    </div>
                                    <div class="col-md-8"> : {{ \Carbon\Carbon::parse($pegawai->thn_lulus)->format('Y') }}
                                    </div>
                                </div>
                                <hr>
                                {{-- cek apakah pegawai mempunyai dokumen yang memiliki jenis_dokumen = 'pendidikan' --}}
                                @php
                                    $dokumen = $pegawai->dokumen->whereIn('jenis_dokumen', ['ijazah', 'sertifikat'])
                                @endphp
                                @if ($dokumen->count() > 0)
                                    @foreach ($dokumen->all() as $item)
                                        <!-- row 4 -->
                                        <div class="row">
                                            <div class="col-md-4"> {{$item->nama_dokumen}}
                                            </div>
                                            <div class="col-md-4"> : <a href="{{ asset('storage/dokumen/'.$item->lokasi_file) }}" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-pdf"></i> {{$item->jenis_dokumen}}.{{pathinfo($item->lokasi_file, PATHINFO_EXTENSION);}}</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="#" class="btn btn-danger btn-sm float-right delete-file" data-id="{{$item->id}}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#modalPend"><i class="fa fa-plus"></i> Upload Dokumen Pendidikan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.pegawai.tambah_pend')
    @include('admin.pegawai.detail_mutasi')
    @include('admin.pegawai.detail_jabatan')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.delete-file').click(function (e) {
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
                        url: `/pegawai/${id}/delete-file`,
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
        });
    })
</script>
@endpush
