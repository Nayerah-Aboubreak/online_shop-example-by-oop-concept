<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';
require_once 'classes/Category.php';
require_once 'classes/Order.php';
require_once 'classes/OrderDetails.php';

$ord = new Order ;
$orders = $ord->getAll();

$ordDet = new OrderDetails;
$orderDetails = $ordDet->getAll();
$prod = new Product;

?>




<div class="container my-5">
    <div class="row">
        <div class="col-md-12">

        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Customer Address</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                </tr>
            </thead>

            <?php foreach($orders as $order => $value)
            {
               $order_id =$value['id'];
               $order_customerName =$value['customerName'];
               $order_customerEmail =$value['customerEmail'];
               $order_customerPhone =$value['customerPhone'];
               $order_customerAddress =$value['customerAddress'];
               
               //echo $order_id .'</br>';
               
               
               foreach($orderDetails as $orderDetail => $value)
               {

                $order_id_det =$value['order_id'];
                $order_id_prod = $value['product_id'];
                //echo $order_id_det;
                
               
                if($order_id == $order_id_det){

                    $product = $prod->getOne($order_id_prod);
                    //var_dump($product);

                

                ?> 
                        <tbody>
                            <tr>
                                <td scope="row"><?php echo $order_customerName; ?></td>
                                <td><?php echo $order_customerEmail; ?></td>
                                <td><?php echo $order_customerPhone; ?></td>
                                <td><?php echo $order_customerAddress; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><img src="images/<?php echo $product['img'] ?>" class="img-fluid"></td>
                                <td><?php echo $product['price']; ?></td>
                            </tr>
                        </tbody>
                <?php }}}?>
            

        </table>

        </div>
    </div>
</div>






<?php require_once 'includes/footer.php';?>