<?php 

session_start();

require_once '../classes/product.php';
require_once '../classes/validation/Validator.php';

use helpers\Image;
use validation\Validator;

if(!isset($_SESSION['id'])){
    header('location:../login.php');
    die();
  }


// if form is submitted
if(isset($_POST['submit']))
{
    $id = $_GET['id'];
    // read data from form 
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    // validation
    $v = new Validator;
    $v->rules('name',$name , ['required','string','max:100']);
    $v->rules('description',$description, ['required','string']);
    $v->rules('price',$price , ['required','numeric']);
    $v->rules('quantity',$quantity , ['required','numeric']);

    /*var_dump($v->errors);
    die();*/
    $errors = $v->errors;




    //if data is valid
    if($errors == [])
    {
        // update in db
        $data = [
            'name'=> $name,
            'price'=> $price,
            'quantity'=> $quantity,
            'desc'=> $description
        ];
        $prod = new Product;
        $result = $prod->update($id, $data);

        // if stored successfully
        if($result == true)
        {
            header('location:../show.php?id='.$id) ;
        } else
        {
            $_SESSION['errors']= ['error updating in database'];
            header('location:../edit.php?id='.$id);
        }

    }else
    {
        $_SESSION['errors']= $errors;
        header('location:../edit.php?id='.$id);
    }


}else
{
    header('location:../index.php');
}
?>