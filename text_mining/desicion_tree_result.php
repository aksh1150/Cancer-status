<?php


echo "<pre>";
echo "Using training data to generate Decision tree...\n";

$dec_tree = new DecisionTree('', 1);

echo "Decision tree using ID3:\n";
$dec_tree->display();

echo "Prediction on new data set\n";
$dec_tree->predict_outcome('');

echo "</pre>";

/*echo "<pre>";
echo "Using training data to generate Decision tree...\n";

//$dec_tree = new DecisionTree('../cancer_data/temp_dummy_data.csv', 1);
$dec_tree = new DecisionTree('', 1);
echo "Decision tree using ID3:\n";
$dec_tree->display();
echo "Prediction on new data set\n";
//$dec_tree->predict_outcome('input_data-t.csv');
//$dec_tree->predict_outcome('../cancer_data/input_data.csv');
$dec_tree->predict_outcome('');
echo "</pre>";*/

?>