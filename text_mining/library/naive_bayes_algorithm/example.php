<?php echo '<pre>';

include './autoload.php';

$tokenizer = new HybridLogic\Classifier\Basic;
$classifier = new HybridLogic\Classifier($tokenizer);

$classifier->train('Stomac Cancer', 'Smoking');
$classifier->train('Stomac Cancer', 'Alcohol');
$classifier->train('Stomac Cancer', 'Chewing');
$classifier->train('Stomac Cancer', 'Diet');
$classifier->train('Stomac Cancer', 'Family History Of Cancer');
$classifier->train('Stomac Cancer', 'Relation With Cancer Patient');
$classifier->train('Stomac Cancer', 'Are You Diagnosed With Cancer Earlier');

$classifier->train('Head & Neck Cancer', 'Smoking');
$classifier->train('Head & Neck Cancer', 'Alcohol');
$classifier->train('Head & Neck Cancer', 'Chewing');
$classifier->train('Head & Neck Cancer', 'Passive Smoking');
$classifier->train('Head & Neck Cancer', 'Weight Loss');
$classifier->train('Head & Neck Cancer', 'Are You Diagnosed With Cancer Earlier');

$classifier->train('Breast Cancer', 'Smoking');
$classifier->train('Breast Cancer', 'Alcohol');
$classifier->train('Breast Cancer', 'Family History Of Cancer');
$classifier->train('Breast Cancer', 'Relation With Cancer Patient');
$classifier->train('Breast Cancer', 'Weight Loss');
$classifier->train('Breast Cancer', 'Anemia');
$classifier->train('Breast Cancer', 'Are You Diagnosed With Cancer Earlier');

$classifier->train('Chest Cancer', 'Smoking');
$classifier->train('Chest Cancer', 'Alcohol');
$classifier->train('Chest Cancer', 'Diet');

$classifier->train('Pelvis Cancer', 'Smoking');
$classifier->train('Pelvis Cancer', 'Smoking');
$classifier->train('Pelvis Cancer', 'Smoking');

$groups = $classifier->classify('Smoking Alcohol');

//var_dump($groups);

echo "<pre>";
print_r($groups);
echo "</pre>";