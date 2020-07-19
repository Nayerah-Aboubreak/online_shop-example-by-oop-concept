<?php

session_start();

require_once '../classes/product.php';
require_once '../classes/Order.php';
require_once '../classes/Category.php';
require_once '../classes/OrderDetails.php';
require_once '../classes/validation/Validator.php';

use validation\Validator;

// if form is submitted
if(isset($_POST['submit']))
{
    // read data from form 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    

    // validation

    $v = new Validator;
    $v->rules('name',$name , ['required','string','max:100']);
    $v->rules('email',$email, ['required','email']);
    $v->rules('phone',$phone , ['required','numeric']);
    $v->rules('address',$address , ['required','string']);



    /*var_dump($v->errors);
    die();*/
    $errors = $v->errors;

    //if data is valid
    if($errors==[])
    {

        // store in db
        $data =[
            'customerName'=>$name,
            'customerEmail'=>$email,
            'customerPhone'=>$phone,
            'customerAddress'=>$address
        ];

        $order = new Order;
        $result1 = $order->store($data);

        foreach($_SESSION['cart'] as $cartId)
        {
            $prod = new Product;
            $product = $prod->getOne($cartId);
            $category_type = $product['category'];

            $cat = new Category;
            $category = $cat->getAll();


            foreach($categories as $category=> $value)
            {
                if($value['type'] == $category_type)
                {
                    $category_id= $value['category_id'];
                     //echo $category_id .'</br>';        
                }
            }
            
            
            $category = $cat->getOne($category_id);

            $ord = new Order;
            $order = $ord->getOne($email);

            $product_id = $cartId;
            $order_id = $order['id'];
            $priceEach = $product['price'];


            $productData =[
                'product_id'=>$product_id ,
                'order_id'=>$order_id,
                'priceEach'=>$priceEach
            ];

            $orderDet = new OrderDetails;
            $result2 = $orderDet->store($productData);


        }

        // if stored successfully
        if($result1 == true and $result2 == true)
        {
            header('location:../index.php');
            session_destroy();
        } else
        {
            $_SESSION['errors']= ['error storing in database'];
            header('location:../buyProducts.php');

        }
    }else
    {
        $_SESSION['errors']= $errors;
        header('location:../buyProducts.php');
    }


}else
{
    header('location:../buyProducts.php');
}

?>