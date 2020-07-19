<?php 

session_start();

require_once '../classes/product.php';
require_once '../classes/helpers/image.php';
require_once '../classes/validation/Validator.php';
use helpers\Image;
use validation\Validator;

if(!isset($_SESSION['id'])){
    header('location:../login.php');
    die();
  }
/*

if (from form)
{
    // read data
    // validation
    if(valid)
    {
        // prepare date
        // store in db
        if(stored){
            upload image
            success // redirect to index for example
        }else{
        redirect with errors
        }
    }else{
        redirect with errors
    }
}else{
    redirect
}
*/


// if form is submitted
if(isset($_POST['submit']))
{
    // read data from form 
    $name = $_POST['name'];
    $description = $_POST['description'];
    $img = $_FILES['img'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    

    // validation

    $v = new Validator;
    $v->rules('name',$name , ['required','string','max:100']);
    $v->rules('description',$description, ['required','string']);
    $v->rules('price',$price , ['required','numeric']);
    $v->rules('quantity',$quantity , ['required','numeric']);
    $v->rules('category',$category , ['required','string','max:100']);

    $v->rules('img',$img , ['required-image','image']);


    /*var_dump($v->errors);
    die();*/
    $errors = $v->errors;

    //if data is valid
    if($errors==[])
    {
        $image = new Image($img);

        // store in db
        $data =[
            'name'=>$name,
            'desc'=>$description,
            'img'=>$image->new_name,
            'price'=>$price,
            'quantity'=>$quantity,
            'category'=>$category
        ];
        $product = new Product;
        $result = $product->store($data);

        // if stored successfully
        if($result == true)
        {
            // upload image
            $image->upload();

            header('location:../index.php');
        } else
        {
            $_SESSION['errors']= ['error storing in database'];
            header('location:../add.php');
        }
    }else
    {
        $_SESSION['errors']= $errors;
        header('location:../add.php');
    }


}else
{
    header('location:../add.php');
}
?>