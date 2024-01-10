<!DOCTYPE html>
<html>
<head>
    <title>Rubix ML Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400"></canvas>

    <script>
        // Contoh data hasil klustering
        var data = {!! json_encode($dataWithClusters) !!};

        // Inisialisasi label dan data untuk Chart.js
        var labels = data.map(function (row) {
            return row['pendidikan'] + ', ' + row['jabatan'] + ', ' + row['status_menikah'];
            // switch (row['pendidikan']) {
            //     case 0:
            //         return 'SMP';
            //     case 1:
            //         return 'SMA';
            //     case 3:
            //         return 'S2';
            //     case 4:
            //         return 'S3';
            //     case 11:
            //         return 'S1';
            //     default:
            //         return 'Unknown';
            // }
        });

        console.log(labels);

        var datasets = [];
        for (var cluster = 0; cluster < 3; cluster++) {
            var filteredData = data.filter(function (row) {
                return row['cluster'] === cluster;
            });

            var dataPoints = filteredData.map(function (row) {
                return row['lama_kerja'];
            });

            datasets.push({
                label: 'Cluster ' + cluster,
                data: dataPoints,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            });
        }

        // Konfigurasi Chart.js
        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        labels: labels
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Membuat grafik dengan Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, config);
    </script>
</body>
</html>
