<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';
require_once 'classes/helpers/str.php';

use helpers\Str;

$prod =new Product;
$products = $prod->getAll();

?>

<div class="container my-5">
    <div class="row">

    <?php if($products !==[]) { ?>
        <?php foreach($products as $product){ ?>
        <div class="col-md-4 mb-3">

        <div class="card">
            <img src="images/<?php echo $product['img'] ?>" class="card-img-top" style="height: 320px;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                <small class="text-muted">Price : $<?php echo $product['price'] ?></small>
                <p class="card-text"><?php echo Str::limit($product['desc']) ; ?></p>
                <a href="show.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">SHOW</a>

                <?php if(isset($_SESSION['id'])){ ?>
                    
                <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-info">EDIT</a>
                <a href="handles/handleDelete.php?id=<?php echo $product['id']; ?>" class="btn btn-danger">DELETE</a>

                <?php } ?>
            </div>
        </div>

        </div>
        <?php } ?>
    <?php }  else { echo '<p> NO PRODUCTS FOUND</p>';}?>

    </div>
</div>







<?php require_once 'includes/footer.php';?>