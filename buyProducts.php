<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';
require_once 'classes/Category.php';





?>




<div class="container my-5">
    <div class="row">
        <div class="col-md-12">

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Desc</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                </tr>
            </thead>

            <?php if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cartId)
                {
                    $prod =new Product;
                    $product = $prod->getOne($cartId);

                    $category_type = $product['category'];


                    $cat = new Category;
                    $categories = $cat->getAll();


                    foreach($categories as $category=> $value)
                    {
                        if($value['type'] == $category_type)
                            {
                                $category_id= $value['category_id'];       
                            }
                    }
                    $category = $cat->getOne($category_id);
                ?> 
                        <tbody>
                            <tr>
                                <td scope="row"><?php echo $product['name']; ?></td>
                                <td><?php echo $product['desc']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><img src="images/<?php echo $product['img'] ?>" class="img-fluid"></td>
                                <td><?php echo $category['type'] ; ?></td>
                            </tr>
                        </tbody>
                <?php }?>
            <?php }?>

        </table>

        </div>
    </div>
</div>




<div class="container my-5 ">
    <div class="row">
    
    <div class="div col-md-8  offset-md-2">
    
    <?php if(isset($_SESSION['errors'])){ ?>

      <div class="alert alert-danger">
      <?php foreach($_SESSION['errors'] as $error){ ?>
        <p class="text-center mb-0"><?php echo $error; ?></p>
      <?php } ?>
      </div>

    <?php } ?>

    <?php unset($_SESSION['errors']) ;?>


   

    <form action="handles/handleOrder.php" method="POST">
        <div class="form-group">
            <label >Name :</label>
            <input type="text" class="form-control" placeholder="Enter your name" name="name">
        </div>
        <div class="form-group">
            <label>Email :</label>
            <input type="text" class="form-control" placeholder="Enter your email" name="email">
        </div>
        <div class="form-group">
            <label>Phone :</label>
            <input type="number" class="form-control" placeholder="Enter your phone" name="phone">
        </div>
        <div class="form-group">
            <label>Address :</label>
            <input type="text" class="form-control" placeholder="Enter your address " name="address">
        </div>

        <button type="submit" class="btn btn-primary my-2" name="submit">Checkout</button>
    </form>

    </div>
    </div>
</div>













<?php require_once 'includes/footer.php';?>