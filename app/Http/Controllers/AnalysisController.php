<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Clusterers\GaussianMixture;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Serializers\RBX;
use Rubix\ML\Transformers\NumericStringConverter;
use App\Models\Pegawai;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Extractors\NDJSON;
use LimitIterator;
use Carbon\Carbon;
use Rubix\ML\Clusterers\Seeders\KMC2;
use Rubix\ML\Loggers\Screen;
use Rubix\ML\CrossValidation\Reports\ContingencyTable;
use Rubix\ML\CrossValidation\Metrics\Homogeneity;
use Rubix\ML\Transformers\MinMaxNormalizer;

class AnalysisController extends Controller
{

    public function createAnalysis() {
        return view('admin.analysis.create');
    }

    public function resultAnalysis(Request $request) {
        $pegawai = Pegawai::get()->toArray();

        $attributes = $request->input('attributes');
        $k = $request->input('k');
        $maxIteration = $request->input('maxIteration');

        $data = filterAttributes($pegawai, $attributes);

        $dataset = new Unlabeled($data);
        $dataset->apply(new OneHotEncoder());

        $estimator = $this->trainModel($dataset, $k, $maxIteration);
        $predictions = $estimator->predict($dataset);

        foreach ($data as $key => $value) {
            $data[$key]["cluster"] = $predictions[$key];
        }

        $attributeNumeric = attributeNumericCalculation($data, $attributes);
        $attributeString = attributeStringCalculation($data, $attributes);

        $clusterSummary = combineAttributeResults($attributeString, $attributeNumeric);


        return view('admin.analysis.result', [
            'data' => $data,
            'clusterSummary' => $clusterSummary,
            'attributes' => $attributes,
            'totalClusters' => count($clusterSummary),
        ]);
    }

    public function trainModel($dataset, $k = 3, $maxIteration = 100) {
        $estimator = new GaussianMixture($k, 1e-6, $maxIteration, 1e-4, new KMC2());

        $estimator->train($dataset);

        return $estimator;
    }
}
