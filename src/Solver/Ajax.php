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

function filterCarExpenseByMonth() {
    if ( isset($_POST) ) {
        extract($_POST);
    } else {
        return;
    }

    $max_day_for_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    if ( $month < 10 ) {
        $month = '0' . $month;
    }
    $from_date  = $year . '-' . $month . '-01'; 
    $to_date    = $year . '-' . $month . '-' . $max_day_for_month;

    if ( isset($user_id) && intval($user_id) > 0 ) {
        $user_id = intval($user_id);
    }
    if ( isset($car_id) && intval($car_id) > 0 ) {
        $car_id = intval($car_id);
    }

    $sql = 'select * from car_expenses as ce
            inner join cars as c ON c.car_id = ce.car_id
            where c.user_id = '. $user_id .' and ce.car_id = ' . $car_id . '
            AND (ce.expense_create_date > "'.$from_date.'" and ce.expense_create_date < "'.$to_date.'")
            order by ce.expense_id';
    $car_expense = \DB::get()->query( $sql );

    $results = [];
    foreach( $car_expense as $key => $value ) {
        $results[$key] = $value;
    }

    echo json_encode(['status' => true, 'results' => $results]);
    exit();
}

