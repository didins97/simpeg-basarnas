@extends('app')

@section('title', 'Grafik Analisis Mixture')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Analisis Mixture</h6>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
            <div class="card-footer">
                <h6 class="m-0 font-weight-bold text-info">Kesimpulan:</h6>
                <ul>
                    @foreach ($clusterSummary as $cluster => $summary)

                        <li>
                            Klaster {{ $cluster }}:
                            @if (in_array('usia', $attributes))
                                Rata-rata Usia {{ $summary['avg_usia'] }},
                            @endif
                            @if (in_array('lama_kerja', $attributes))
                                Rata-rata Lama Kerja {{ floor($summary['avg_lama_kerja'] / 12); }} tahun {{  $summary['avg_lama_kerja'] % 12; }} bulan,
                            @endif
                            @if (in_array('pend_terakhir', $attributes))
                                Pendidikan Umum {{ $summary['modus_pend_terakhir'] }},
                            @endif
                            @if (in_array('jabatan', $attributes))
                                Jabatan Umum {{ $summary['modus_jabatan'] }},
                            @endif
                            @if (in_array('jns_kelamin', $attributes))
                                Jenis Kelamin Umum {{ $summary['modus_jns_kelamin'] }}.
                            @endif
                            @if (in_array('unit_kerja', $attributes))
                                Unit Kerja Umum {{ $summary['modus_unit_kerja'] }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Contoh data klaster (ganti dengan data yang sesuai)
        var data = @json($data);
        var totalClusters = @json($totalClusters);

        var ctx = document.getElementById('myChart').getContext('2d');
        var scatterChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: []
            },
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        scaleLabel: {
                            display: true,
                            labelString: 'Usia'
                        }
                    },
                    y: {
                        type: 'linear',
                        position: 'left',
                        scaleLabel: {
                            display: true,
                            labelString: 'Gaji'
                        }
                    }
                }
            }
        });

        var clusterColors = [
            'rgba(75, 192, 192, 0.5)',
            'rgba(255, 99, 132, 0.5)', // Ganti dengan warna yang sesuai
            'rgba(255, 205, 86, 0.5)' // Ganti dengan warna yang sesuai
        ];

        // Tambahkan dataset untuk setiap klaster
        for (var cluster = 0; cluster < totalClusters; cluster++) {
            var clusterData = data.filter(function(item) {
                return item.cluster === cluster;
            });

            var dataset = {
                label: 'Klaster ' + cluster,
                data: clusterData.map(function(item) {
                    return {
                        x: item.lama_kerja,
                        y: item.usia
                    };
                }),
                backgroundColor: clusterColors[cluster],
                borderColor: clusterColors[cluster],
                borderWidth: 1
            };

            scatterChart.data.datasets.push(dataset);
        }

        // Perbarui grafik
        scatterChart.update();
    </script>
@endpush
