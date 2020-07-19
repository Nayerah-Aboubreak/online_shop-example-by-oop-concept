<?php 
require_once 'includes/header.php';
require_once 'classes/product.php';


if(!isset($_SESSION['id'])){
  header('location:login.php');
}

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


   

    <form action="handles/handleAdd.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label >Name Of Product :</label>
    <input type="text" class="form-control" placeholder="Enter the name of product" name="name">
  </div>
  <div class="form-group">
    <label>Price Of Product :</label>
    <input type="number" class="form-control" placeholder="Enter the price of product" name="price">
  </div>
  <div class="form-group">
    <label>Category Of Product :</label>
    <input type="text" class="form-control" placeholder="Enter the category of product" name="category">
  </div>
  <div class="form-group">
    <label>Quantity In Stock :</label>
    <input type="number" class="form-control" placeholder="Enter the quantity " name="quantity">
  </div>
  <div class="form-group">
    <label>Type the Description :</label>
    <textarea class="form-control"  rows="4" placeholder="Type the description " name="description"></textarea>
  </div>

  <div class="form-group my-2">
    <input type="file" name="img" value="choose image">
  </div>

  <button type="submit" class="btn btn-primary my-2" name="submit">ADD</button>
</form>

</div>
    </div>
</div>







<?php require_once 'includes/footer.php';?>