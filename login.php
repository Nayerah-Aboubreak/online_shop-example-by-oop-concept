<?php
require_once 'includes/header.php';
require_once 'classes/product.php';
require_once 'classes/Admin.php';

if(isset($_SESSION['id'])){
  header('location:index.php');
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

<form action="handles/handleLogin.php" method="POST">
  <div class="form-group">
    <label>Type your Name:</label>
    <input type="text" class="form-control" placeholder="type your name" name="username">
  </div>
  <div class="form-group">
    <label>Type your Email :</label>
    <input type="email" class="form-control" placeholder="type your email" name="email">
  </div>
  <div class="form-group">
    <label>Password :</label>
    <input type="password" class="form-control" placeholder="type your password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary my-2" name="submit">LOGIN</button>
</form>
</div>
    </div>
</div>







<?php require_once 'includes/footer.php';?>

