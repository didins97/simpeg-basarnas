<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rubix\ML\Clusterers\GaussianMixture;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Transformers\NumericStringConverter;
use Rubix\ML\CrossValidation\Metrics\Homogeneity;
use Rubix\ML\CrossValidation\Metrics\MutualInformation;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Clusterers\Seeders\KMC2;
use Rubix\ML\Transformers\CategoricalLabelEncoder;

class GMMController extends Controller
{
    public function index() {
        $data = [
            ['pendidikan' => 'SMP', 'gender' => 'Perempuan', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 5],
            ['pendidikan' => 'SMA', 'gender' => 'Laki-laki', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 7],
            ['pendidikan' => 'SMA', 'gender' => 'Perempuan', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 10],
            ['pendidikan' => 'S2', 'gender' => 'Perempuan', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 12],
            ['pendidikan' => 'S3', 'gender' => 'Perempuan', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 15],
            ['pendidikan' => 'SMA', 'gender' => 'Perempuan', 'jabatan' => 'karyawan_swasta', 'status_menikah' => 'menikah', 'lama_kerja' => 20],
            ['pendidikan' => 'S2', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 25],
            ['pendidikan' => 'S3', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 30],
            ['pendidikan' => 'SMA', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 35],
            ['pendidikan' => 'S2', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 40],
            ['pendidikan' => 'S3', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 45],
            ['pendidikan' => 'S1', 'gender' => 'Perempuan', 'jabatan' => 'manager', 'status_menikah' => 'menikah', 'lama_kerja' => 50],
            ['pendidikan' => 'S2', 'gender' => 'Perempuan', 'jabatan' => 'ceo', 'status_menikah' => 'menikah', 'lama_kerja' => 55],
        ];

        $encodedData = $this->labelEncodeColumn($data, 'pendidikan');
        $encodedData = $this->labelEncodeColumn($encodedData, 'gender');
        $encodedData = $this->labelEncodeColumn($encodedData, 'jabatan');
        $encodedData = $this->labelEncodeColumn($encodedData, 'status_menikah');

        // dd(array_column($encodedData, 'pendidikan'));

        // dd($encodedData);

        $dataset = new Labeled($encodedData, array_column($encodedData, 'lama_kerja'));

        // Membuat model GMM
        $model = new GaussianMixture(3);

        // Melatih model GMM
        $model->train($dataset);

        // Menggunakan model GMM
        $predictions = $model->predict($dataset);

        // meneambahkan label klaster ke data
        $dataWithClusters = array_map(function ($row, $label) {
            $row['cluster'] = $label;
            return $row;
        }, $encodedData, $predictions);

        return view('test', ['dataWithClusters' => $dataWithClusters]);
    }

    function labelEncodeColumn(array $data, string $columnName): array
    {
        $uniqueValues = array_unique(array_column($data, $columnName));
        $encodedData = $data;

        $mapping = array_flip($uniqueValues);

        foreach ($encodedData as &$row) {
            $row[$columnName] = $mapping[$row[$columnName]];
        }

        return $encodedData;
    }
}
