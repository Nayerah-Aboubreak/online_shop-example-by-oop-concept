<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';

if(!isset($_SESSION['id'])){
  header('location:login.php');
}

$id=$_GET['id'];

$prod =new Product;
$product = $prod->getOne($id);

?>

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
    
    <form action="handles/handleEdit.php?id=<?php echo $product['id']; ?>" method="POST">
  <div class="form-group">
    <label >Name Of Product :</label>
    <input type="text" class="form-control" value="<?php echo $product['name']; ?>" name="name">
  </div>
  <div class="form-group">
    <label>Price Of Product :</label>
    <input type="number" class="form-control" value="<?php echo $product['price']; ?>" name="price">
  </div>
  <div class="form-group">
    <label>Quantity In Stock :</label>
    <input type="number" class="form-control" value="<?php echo $product['quantity']; ?>" name="quantity">
  </div>
  <div class="form-group">
    <label>Type the Description :</label>
    <textarea class="form-control"  rows="4"  name="description"><?php echo $product['desc']; ?></textarea>
  </div>


  <button type="submit" class="btn btn-primary my-2" name="submit">UPDATE</button>
</form>

</div>
    </div>
</div>







<?php require_once 'includes/footer.php';?>