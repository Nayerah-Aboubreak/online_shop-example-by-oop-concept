<?php 

session_start();

require_once '../classes/Category.php';
require_once '../classes/validation/Validator.php';

use validation\Validator;

if(!isset($_SESSION['id'])){
    header('location:../login.php');
    die();
  }


// if form is submitted
if(isset($_POST['submit']))
{
    // read data from form 
    $category = $_POST['category'];
    
    

    // validation

    $v = new Validator;
    $v->rules('category',$category , ['required','string','max:100']);
   


    /*var_dump($v->errors);
    die();*/
    $errors = $v->errors;

    //if data is valid
    if($errors==[])
    {

        // store in db
        $data =[
            'type'=>$category
        ];
        $category = new Category;
        $result = $category->store($data);

        // if stored successfully
        if($result == true)
        {
            header('location:../index.php');
        } else
        {
            $_SESSION['errors']= ['error storing in database'];
            header('location:../addCat.php');
        }
    }else
    {
        $_SESSION['errors']= $errors;
        header('location:../addCat.php');
    }


}else
{
    header('location:../addCat.php');
}
?>