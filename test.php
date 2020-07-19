<?php

require_once 'classes/product.php';

/*$prod = new Product ;
var_dump($prod->getAll());
echo '<br><br><br>';
var_dump($prod->getOne(2));
echo '<br><br><br>';
var_dump($prod->getOne(4));
echo '<br><br><br>';
echo $prod->store([
    'name'=>'new product',
    'desc'=>'new product',
    'img'=>'4.jpg',
    'price'=>49.99,
]);
echo $prod->update(4,[
    'name'=>'new product updated',
    'desc'=>'new product',
    'img'=>'4.jpg',
    'price'=>49.99,
]);
echo $prod->delete(4);*/

// for image
if(isset($_POST['submit']))
{
    $img = $_FILES['img'];
    //var_dump($img);
    $name = $img['name'];
    $tmp_name = $img['tmp_name'];
    $extension = pathinfo($name)['extension'];
    $new_name = uniqid().'.'.$extension;
    
    move_uploaded_file($tmp_name,'images/'.$new_name);

    //echo $name .'<br>' ;
   //echo $tmp_name .'<br>';
   //var_dump(pathinfo('my-image.jpf'));
   //var_dump(pathinfo($name));
   //echo $extension;
   echo $new_name ;

    // name , tmp_name , new_name==>uniqid()

    
    
}

?>
<form action="test.php" method="post" enctype="multipart/form-data">
    <input type="file" name="img" value="choose image">
  <button type="submit"  name="submit">ADD</button>
</form>
<?php $password = '123456'; echo sha1($password);?>