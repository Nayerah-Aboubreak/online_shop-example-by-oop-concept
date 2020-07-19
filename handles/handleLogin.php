<?php 

session_start();
require_once '../classes/Admin.php';
require_once '../classes/validation/Validator.php';

use validation\Validator;



// if form is submitted
if(isset($_POST['submit']))
{
    // read data from form 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username= $_POST['username'];
    

    // validation

    $v = new Validator;
    $v->rules('username',$username , ['required','string','max:100']);
    $v->rules('email',$email , ['required','email','max:100']);
    $v->rules('password',$password, ['required','string']);
   
    /*var_dump($v->errors);
    die();*/
    $errors = $v->errors;

    //if data is valid
    if($errors==[])
    {
        $admin =new Admin;
        $result = $admin->attempt($email , sha1($password) , $username); //

        // if stored successfully
        if($result !== NULL)
        {
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            header('location:../index.php');
        } else
        {
            $_SESSION['errors'] = [' Your credentials are not correct'];
            header('location:../login.php');
            
        }
    }else
    {
        $_SESSION['errors'] =$errors;
        header('location:../login.php');
    }


}else
{
    header('location:../login.php');
}
?>