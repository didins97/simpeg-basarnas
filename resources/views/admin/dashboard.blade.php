@extends('app')

@section('title', 'Dashboard')

@section('css')
    <style>
        .info-box {
            min-height: 120px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalPegawai }}</h3>

                        <p>Total Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalMutasi }}</h3>

                        <p>Total Mutasi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalJabatan }}</h3>

                        <p>Total Jabatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$totalUser}}</h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Grafik Gender Pegawai</h3>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <canvas id="chartGender"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pegawai Aktif</span>
                        <span class="info-box-number">{{ $totalPegawaiAktif }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <div class="info-box mb-3 bg-danger">
                    <span class="info-box-icon"><i class="fas fa-people-carry"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pegawai Menikah</span>
                        <span class="info-box-number">{{ $totalPegawaiMenikah }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pegawai Pendidikan Diatas SMA</span>
                        <span class="info-box-number">{{ $totalPegawaiSMAKeatas }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function () {
            console.log({{ $totalPegawaiPria }}, {{ $totalPegawaiWanita }});
            var ctx = document.getElementById('chartGender').getContext('2d');
            var genderChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Laki-laki',
                        'Perempuan',
                    ],
                    datasets: [{
                        data: [{{$totalPegawaiPria}}, {{$totalPegawaiWanita}}],
                        // data: [0, 0],
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                            'rgb(255, 99, 132)',
                        ]
                    }],
                },
            });
        });
    </script>
@endpush
