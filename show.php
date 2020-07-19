<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';
require_once 'classes/Category.php';

$id=$_GET['id'];
$_SESSION['prodId'] =$id;

if(! isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}


if(isset($_POST['cart']))
{
    array_push($_SESSION['cart'] , $_SESSION['prodId']);
}


$prod =new Product;
$product = $prod->getOne($id);
$category_type = $product['category'];

  //echo $category_type.'</br>';

$cat = new Category;
$categories = $cat->getAll();


foreach($categories as $category=> $value)
{
    if($value['type'] == $category_type)
    {
        $category_id= $value['category_id'];
        //echo $category_id .'</br>';        
    }
}
$category = $cat->getOne($category_id);
?>

<div class="container my-5">
    <div class="row">
    <?php if($product !== NULL) { ?>

        <div class="col-md-6">
            <img src="images/<?php echo $product['img'] ?>" class="img-fluid" style="height: 400px;">
        </div>
        <div class="col-md-6">

            <h5><?php echo $product['name'] ?></h5>
            <small class="text-muted">Price : $<?php echo $product['price'] ?></small>
            <p ><?php echo $product['desc'] ; ?></p>

            <P>Quantity : <span class="text-muted"><?php echo $product['quantity'] ?></span> pieces.</P>
            <P>Category : <span class="text-muted"><?php echo $category['type'] ?></span></P>


            <div class="row">
                <div class="col-lg-3">
                <a href="index.php" class="btn btn-secondary px-5">BACK</a>
                </div>

                <div class="col-md-3">
                <form method="POST" action="show.php?id=<?php echo $product['id']; ?>">
                    <input class="btn btn-success px-4" type="submit" name="cart" value="Add to Cart">
                </form>
                </div>

                <div class="col-md-3">
                <?php if(isset($_POST['cart'])){ ?>
                <a href="buyProducts.php" class="btn btn-primary px-2">Buy Product</a>
                <?php } ?>
                    
                </div>
            </div>
              
            
                <?php if(isset($_SESSION['id'])){ ?>
                    <div class="row my-2 mx-2">
                        <div class="col-lg-4 ">
                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-info px-5">EDIT</a>
                        </div>
                        <div class="col-lg-4 ">
                        <a href="handles/handleDelete.php?id=<?php echo $product['id']; ?>" class="btn btn-danger px-5">DELETE</a>
                        </div>
                    </div>
                <?php } ?>
            
        </div>

    <?php }  else { echo '<p> NO PRODUCT FOUND</p>';}?>  
    </div>
</div>







<?php require_once 'includes/footer.php';?>