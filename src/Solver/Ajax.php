<?php

require __DIR__ . '/../config.php';

if ( $_GET['function'] ) {
    $_GET['function']();
}

function getModelsByMark() {

    if ( isset($_POST) ) {
        extract($_POST);
    } else {
        return;
    }

    if ( isset($mark_id) && intval($mark_id) > 0 ) {
        $mark_id = intval($mark_id);
    }

    $mark_models = \DB::get()->query('select model_id, model_name from car_models where mark_id = ' . $mark_id . ' and model_status = 0');
    $results = [];
    foreach( $mark_models as $model_id => $mark_model ) {
        $results[$model_id] = $mark_model;
    }

    echo json_encode(['status' => true, 'results' => $results]);
    exit();
}

