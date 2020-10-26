<?php

namespace Solver\Controller;

use Solver\Controller;

class Cars extends Controller {

    public function view( $request ) {

        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        if ( isset($_SESSION["user_id"]) ) {
            $user_id = $_SESSION["user_id"];
        }  

        $cars = \DB::get()->query('select * from cars as c
                    inner join car_marks as cm on cm.mark_id = c.mark_id
                    inner join car_models as cmod on cmod.model_id = c.model_id
                    where c.car_status = 0 and c.user_id = '.$user_id.'
                    order by c.car_id');

        $this->view->assign('cars', $cars);

        include ($this->view->getPath() . '/cars/view.html');

    }

    public function create( $request ) {
        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        if ( isset($_SESSION["user_id"]) ) {
            $user_id = $_SESSION["user_id"];
        }        

        $marks = \DB::get()->query('select mark_id, mark_name from car_marks where mark_status = 0 order by mark_name asc');
        $this->view->assign('marks', $marks);

        $models = \DB::get()->query('select model_id, model_name from car_models where model_status = 0 order by model_name asc');
        $this->view->assign('models', $models);

        if ( $request->isPost() ) {

            extract($request->getPost());

            $errors = $this->validateFeld($request->getPost());

            if ( empty($errors) ) {
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO cars (user_id, mark_id, model_id, car_register_number, car_create_date)
                VALUES ('$user_id', '$mark_id', '$model_id', '$car_register_number', '$date')";
                
                \DB::get()->query($sql);
                $request->to('cars&action=view');
            } else {
                $this->view->assign('errors', $errors);
                $this->view->assign('mark_id', $mark_id);
                $this->view->assign('model_id', $model_id);
                $this->view->assign('car_register_number', $car_register_number);
            }

        }

        include ($this->view->getPath() . '/cars/create.html');
    }

    public function edit( $request ) {
        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }
        $user_id = $_SESSION["user_id"];

        $marks = \DB::get()->query('select mark_id, mark_name from car_marks where mark_status = 0 order by mark_name asc');
        $this->view->assign('marks', $marks);

        $models = \DB::get()->query('select model_id, model_name from car_models where model_status = 0 order by model_name asc');
        $this->view->assign('models', $models);

        if ( $request->isPost() ) {

            extract($request->getPost());  
            
            $errors = $this->validateFeld($request->getPost(), $car_id);

            if ( empty($errors) ) {
                $sql = "UPDATE cars SET mark_id = '$mark_id', model_id = '$model_id', car_register_number = '$car_register_number' where car_id = '$car_id'";
                
                \DB::get()->query($sql);
                $request->to('cars&action=view');
            } else {
                $this->view->assign('errors', $errors);
                $this->view->assign('mark_id', $mark_id);
                $this->view->assign('model_id', $model_id);
                $this->view->assign('car_register_number', $car_register_number);
            }

        }
        $selected_car = \DB::get()->query('select * from cars where car_id = '.$car_id.' and car_status = 0');
        foreach($selected_car as $car) {
            $selected_car = $car;
        }
        $this->view->assign('selected_car', $selected_car);

        include ($this->view->getPath() . '/cars/edit.html');
    }

    public function delete( $request ) {
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }
        $user_id = intval($_SESSION['user_id']);
        $sql = "delete from cars where car_id = " .$car_id. " and user_id = " .$user_id;
        \DB::get()->query( $sql );
        $request->to('cars&action=view');
    }

    public function validateFeld( $post, $car_id = 0) {

        $errors = array();
        extract($post);  

        //check for marks
        if ( !isset( $mark_id ) ) {
            $errors['mark_id'] = "You should choose mark!";
        }
        if ( !$this->isExistsCarMarks( $mark_id ) && !(intval($mark_id) > 0) ) {
            $errors['mark_id'] = "This mark don't exists!";
        }

        //check for models
        if ( !isset( $model_id ) ) {
            $errors['model_id'] = "You should choose model!";
        }
        if ( !$this->isExistsCarModels( $model_id ) && !(intval($model_id) > 0) ) {
            $errors['model_id'] = "This model don't exists!";
        }

        //check for register number
        if ( !isset($car_register_number) || empty($car_register_number)  ) {
            $errors['car_register_number'] = "This field is required!";
        }
        if ( $this->isExistsRegisterNumber( $car_register_number, $car_id ) ) {
            $errors['car_register_number'] = "This register number already exists!";
        }

        return $errors;
    }

    public function isExistsCarMarks( $mark_id ) {
        $result = \DB::get()->query( "select mark_id from car_marks 
        where mark_id = '$mark_id' and mark_status = 0" );
        if ( $result->num_rows > 0 ) {
        return true;
        }
        return false;
    }

    public function isExistsCarModels( $model_id ) {
        $result = \DB::get()->query( "select model_id from car_models 
        where model_id = '$model_id' and model_status = 0" );
        if ( $result->num_rows > 0 ) {
        return true;
        }
        return false;
    }

    private function isExistsRegisterNumber( $car_register_number, $car_id = 0 ) {

        $sql = "select car_id, car_register_number from cars 
        where car_register_number = '$car_register_number' and car_status = 0";
        if ( $car_id > 0 ) {
            $sql .= " and car_id <> '$car_id'";         
        }

        $result = \DB::get()->query( $sql );
        if ( $result->num_rows > 0 ) {
            return true;
        }
        return false;
    }

}