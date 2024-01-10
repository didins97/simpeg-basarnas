<?php

if (! function_exists('upload_file')) {
    function upload_file($path, $file, $param1 = null, $param2 = null)
    {
        $param1 = $param1 ?? rand(100000, 999999);
        $param2 = $param2 ?? rand(100000, 999999);

        $fileName = $param1 . '-' . $param2 . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $fileName);

        return $fileName;
    }
}

if (! function_exists('delete_file')) {
    function delete_file($path, $jenis, $param1 = null, $param2 = null)
    {
        Storage::delete($path);
    }
}

if (! function_exists('filterAttributes')) {
    function filterAttributes($data, $attributes)
    {
        return array_map(function ($value) use ($attributes) {
            return array_intersect_key($value, array_flip($attributes));
        }, $data);
    }
}

if (! function_exists('initializeClusterSummary')) {
    function initializeClusterSummary($attributes) {
        $initialSummary = ['count' => 0];

        foreach ($attributes as $attribute) {
            $initialSummary['total_' . $attribute] = 0;

            if ($attribute === 'usia') {
                $initialSummary['avg_' . $attribute] = 0;
            }

            if ($attribute === 'lama_kerja') {
                $initialSummary['avg_' . $attribute] = 0;
            }
        }

        return $initialSummary;
    }
}

if (! function_exists('attributeNumericCalculation')) {
    function attributeNumericCalculation($data, $attributes)
    {
        $numericResults = [];
        $clusterSummary = [];

        foreach ($data as $item) {
            $cluster = $item['cluster'];

            if (!isset($clusterSummary[$cluster])) {
                foreach ($attributes as $attribute) {
                    if (in_array($attribute, ['lama_kerja', 'usia'])) {
                        $clusterSummary[$cluster]['total_' . $attribute] = 0;
                        $clusterSummary[$cluster]['count'] = 0;
                        $clusterSummary[$cluster]['avg_' . $attribute] = 0;
                    }
                }
            }

            foreach ($attributes as $attribute) {
                if (in_array($attribute, ['lama_kerja', 'usia'])) {
                    $clusterSummary[$cluster]['total_' . $attribute] += $item[$attribute];
                }
            }

            $clusterSummary[$cluster]['count']++;
        }

        // Hitung nilai rata-rata untuk setiap atribut numerik pada setiap klaster
        foreach ($clusterSummary as &$summary) {
            foreach ($attributes as $attribute) {
                if (in_array($attribute, ['lama_kerja', 'usia'])) {
                    $summary['avg_' . $attribute] = round($summary['total_' . $attribute] / $summary['count']);
                }
            }
        }

        return $clusterSummary;
    }
}

if (! function_exists('attributeStringCalculation')) {
    function attributeStringCalculation($data, $attributes) {
        $clusterSummary = [];

        // Inisialisasi array untuk menghitung frekuensi masing-masing nilai atribut string di setiap klaster
        foreach ($data as $item) {
            $cluster = $item['cluster'];

            foreach ($attributes as $attribute) {
                if (in_array($attribute, ['pend_terakhir', 'jabatan', 'unit_kerja', 'jns_kelamin'])) {
                    $value = $item[$attribute];
                    $clusterSummary[$cluster][$attribute][$value] = isset($clusterSummary[$cluster][$attribute][$value]) ? $clusterSummary[$cluster][$attribute][$value] + 1 : 1;
                }
            }
        }

        // Hitung modus untuk setiap atribut di setiap klaster
        foreach ($clusterSummary as &$summary) {
            foreach (['pend_terakhir', 'jabatan', 'unit_kerja', 'jns_kelamin'] as $attribute) {
                if (isset($summary[$attribute])) {
                    $maxCount = max($summary[$attribute]);
                    $mode = null;

                    foreach ($summary[$attribute] as $value => $count) {
                        if ($count === $maxCount) {
                            $mode = $value;
                            break;
                        }
                    }

                    // Menambahkan informasi modus dan frekuensi ke dalam array klaster
                    $summary['modus_' . $attribute] = $mode;
                    $summary['count_' . $attribute] = $maxCount;
                }
            }
        }

        return $clusterSummary;
    }
}

if (!function_exists('combineAttributeResults')) {
    function combineAttributeResults($attributeNumeric, $attributeString)
    {
        // Jika $attributeString kosong, gunakan hanya data numerik
        if (empty($attributeString)) {
            return $attributeNumeric;
        }

        // Jika $attributeNumeric kosong, gunakan hanya data string
        if (empty($attributeNumeric)) {
            return $attributeString;
        }
        // Pastikan keduanya memiliki jumlah elemen yang sama
        $countNumeric = count($attributeNumeric);
        $countString = count($attributeString);

        if ($countNumeric !== $countString) {
            throw new \InvalidArgumentException("Jumlah elemen pada data numerik dan string tidak sama.");
        }

        // Inisialisasi hasil kombinasi
        $combinedResults = [];

        // Loop melalui data numerik dan gabungkan
        for ($i = 0; $i < $countNumeric; $i++) {
            $combinedResults[$i] = array_merge($attributeNumeric[$i], $attributeString[$i]);
        }

        return $combinedResults;
    }
}
