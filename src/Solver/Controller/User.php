<?php

namespace Solver\Controller;

use Solver\Controller;

class User extends Controller {

    public function view( $request ) {

        $request->to('user&action=login');

        //view all users
        //include  $this->view->getPath() . '/user/view.html';

    }

    public function create( $request ) {

        if ( $request->isPost() ) {
            $errors = array();

            extract($request->getPost());

            if ( !isset($user_email) ) {
                $errors['user_email'] = "This field is required!";
            } else {
                $user_email = trim($user_email);
            }
            if ( $this->isExistsEmail($user_email) ) {
                $errors['user_email'] = "This email already is registered!";
            }
            if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                $errors['user_email'] = "Invalid email format";
            }

            if ( !isset($user_password) ) {
                $errors['user_password'] = "This field is required!";
            }
            else {
                $user_password = trim($user_password);
            }
            if ( !(strlen($user_password) > 3) ) {
                $errors['user_password'] = "This field must be more than 3 symbols!";
            }

            if ( empty($errors) ) {
                $sql = "INSERT INTO users (user_email, user_password)
                VALUES ('$user_email', '$user_password')";
                
                \DB::get()->query($sql);
                $request->to('login');
            } else {
                $this->view->assign('errors', $errors);
                $this->view->assign('data', $request->getPost());
            }

        }
        include  $this->view->getPath() . '/user/create.html';

    }

    public function login( $request ) {

        if ( $request->isPost() ) {
            $errors = array();

            extract($request->getPost());

            $user_id = '';
            if ( !$this->isExistsEmail($user_email) ) {
                $errors['user_email'] = "This email don't exists yet!";
            } elseif ( !$this->isExistsEmailByPassword( $user_email, $user_password ) ) {
                $errors['user_email'] = "Wring password!";
            } else {
                $user_id = $this->getUserIDByEmail($user_email);
            }     

            if ( empty($errors) ) {
                //add session
                $_SESSION["identity"] = true;
                $_SESSION["user_id"] = $user_id;
                $request->to('cars');
            } else {
                $this->view->assign('errors', $errors);
                $this->view->assign('data', $request->getPost());
            }

        }

        include  $this->view->getPath() . '/user/login.html';
    }

    public function logout( $request ) {
        if (!isset($_SESSION)) return;
        unset($_SESSION['identity']);
        unset($_SESSION['user_id']);
        $request->to('user&action=login');
    }

    private function isExistsEmail( $user_email ) {
        $result = \DB::get()->query( "select user_email from users where user_email = '$user_email'" );
        if ( $result->num_rows > 0 ) {
            return true;
        }
        return false;
    }

    private function isExistsEmailByPassword( $user_email, $user_password ) {
        $result = \DB::get()->query( "select user_email, user_password from users 
                                    where user_email = '$user_email' and user_password = '$user_password' and user_status = 0" );
        if ( $result->num_rows > 0 ) {
            return true;
        }
        return false;
    }

    public function getUserIDByEmail( $user_email ) {
        $result = \DB::get()->query( "select user_id from users 
                                    where user_email = '$user_email' and user_status = 0" );

        foreach( $result as $row) {
            $user_id = $row['user_id'];
        }
        return $user_id;        
    }

}