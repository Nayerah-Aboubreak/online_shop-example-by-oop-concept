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


   

    <form action="handles/handleAddCat.php" method="POST">
  <div class="form-group">
    <label >Type of Category :</label>
    <input type="text" class="form-control" placeholder="Enter the type of category" name="category">
  </div>
 

  <button type="submit" class="btn btn-primary my-2" name="submit">Add Category</button>
</form>

</div>
    </div>
</div>







<?php require_once 'includes/footer.php';?>