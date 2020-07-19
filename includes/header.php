<?php 
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online_Shop</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/index_style.css">
</head>
<body>

<section id="navBar">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
  <a class="navbar-brand" href="index.php">ONLINE_SHOP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">

  <div class="navbar-nav">
      <?php if(isset($_SESSION['id'])){ ?>
        <a class="nav-link text-white " href="#" ><?php echo 'Hello '. $_SESSION['username'];?></a>
      <?php } ?>
      <?php unset($_SESSION['errors']) ;?>
    </div>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">All Products</a>
      </li>

      
      <?php if(isset($_SESSION['id'])){ ?>
        <li class="nav-item">
        <a class="nav-link text-white" href="add.php">Add New</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-white" href="addCat.php">Add Category</a>
        <li class="nav-item">
        <a class="nav-link text-white" href="orders.php">Orders</a>
        </li>
        </li>
      <?php } ?>
      

      <li class="nav-item">
      <?php if(isset($_SESSION['id'])){ ?>
        <a class="nav-link text-white" href="handles/handleLogout.php" >LOGOUT</a>
      <?php } ?>
      </li>
    </ul>
    
  </div>
</nav>

</section>