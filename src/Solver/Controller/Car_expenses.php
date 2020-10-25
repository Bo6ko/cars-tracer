<?php

namespace Solver\Controller;

use Solver\Controller;

class Car_expenses extends Controller {

    public function view( $request ) {

        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }

        $car_expenses = \DB::get()->query('select * from cars as c
                    inner join car_marks as cm on cm.mark_id = c.mark_id
                    inner join car_models as cmod on cmod.model_id = c.model_id
                    inner join car_expenses as ce on ce.car_id = c.car_id
                    where c.car_id = '.$car_id.' and c.car_status = 0 and ce.expense_status = 0
                    order by c.car_id');

        $car = \DB::get()->query('select * from cars as c
                    inner join car_marks as cm on cm.mark_id = c.mark_id
                    inner join car_models as cmod on cmod.model_id = c.model_id
                    where c.car_id = '.$car_id.' and c.car_status = 0');

        $this->view->assign('car_expenses', $car_expenses);
        $this->view->assign('car', $car->fetch_assoc());

        include ($this->view->getPath() . '/car_expenses/view.html');

    }

    public function create( $request ) {
        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        $user_id = $_SESSION["user_id"];
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }

        if ( $request->isPost() ) {

            extract($request->getPost());

            $errors = $this->validateFeld($request->getPost());

            if ( empty($errors) ) {
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO car_expenses (car_id, expense_title, expense_description, expense_price, expense_create_date)
                VALUES ('$car_id', '$expense_title', '$expense_description', '$expense_price', '$date')";
                
                \DB::get()->query($sql);
                $request->to('car_expenses&action=view&car_id=' . $car_id);
            } else {
                $this->view->assign('errors', $errors);
            }

        }
        $this->view->assign('car_id', $car_id);

        include ($this->view->getPath() . '/car_expenses/create.html');
    }

    public function edit( $request ) {
        if ( !$_SESSION['identity'] ) {
            $request->to('user&action=login');
        }
        $user_id = $_SESSION["user_id"];
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }
        if ( !isset($_GET['expense_id']) && !(intval($_GET['expense_id']) > 0) ) {
            return;
        } else {
            $expense_id = $_GET['expense_id'];
        }

        $car_expense = $this->getCurrentCarExpense( $expense_id );

        if ( $request->isPost() ) {

            extract($request->getPost());            

            $errors = $this->validateFeld($request->getPost());

            if ( empty($errors) ) {                
                $sql = "UPDATE car_expenses SET expense_title = '$expense_title', expense_description = '$expense_description', expense_price = '$expense_price' where expense_id = '$expense_id'";

                \DB::get()->query($sql);
                $request->to('car_expenses&action=view&car_id='.$car_id);
            } else {
                $this->view->assign('errors', $errors);
                $this->view->assign('expense_title', $expense_title);
                $this->view->assign('expense_description', $expense_description);
                $this->view->assign('expense_price', $expense_price);
            }

        }
        $this->view->assign('car_id', $car_id);
        $this->view->assign('car_expense', $car_expense);
        

        include ($this->view->getPath() . '/car_expenses/edit.html');
    }

    public function delete( $request ) {
        if ( !isset($_GET['car_id']) && !(intval($_GET['car_id']) > 0) ) {
            return;
        } else {
            $car_id = $_GET['car_id'];
        }
        if ( !isset($_GET['expense_id']) && !(intval($_GET['expense_id']) > 0) ) {
            return;
        } else {
            $expense_id = $_GET['expense_id'];
        }
        $user_id = intval($_SESSION['user_id']);
        $sql = "delete ce from car_expenses as ce
        INNER JOIN cars AS c ON c.car_id = ce.car_id
        where ce.car_id = " .$car_id. " and c.user_id = " .$user_id . " and ce.expense_id = " .$expense_id;
        \DB::get()->query( $sql );
        $request->to('car_expenses&action=view&car_id=' . $car_id);
    }

    public function validateFeld( $post, $car_id = 0) {

        $errors = array();
        extract($post);  

        //check for expense_title
        if ( !isset( $expense_title ) || empty($expense_title) ) {
            $errors['expense_title'] = "This field is required!";
        }

        //check for expense_description
        if ( !isset( $expense_description ) || empty($expense_description) ) {
            $errors['expense_description'] = "You should choose model!";
        }
        if ( ( strlen( $expense_description ) < 10 ) || ( strlen( $expense_description ) > 255 ) ) {
            $errors['expense_description'] = "Required symbols from 10 to 255!";
        }

        //check for expense_price
        if ( !isset($expense_price) || (intval($expense_price) <= 0)  ) {
            $errors['expense_price'] = "This field is required!";
        }

        return $errors;
    }

    public function getCurrentCarExpense( $expense_id ) {
        $result = \DB::get()->query('select * from car_expenses where expense_id = ' . $expense_id);

        foreach( $result as $row) {
            $expense = $row;
        }
        return $expense;        
    }

}