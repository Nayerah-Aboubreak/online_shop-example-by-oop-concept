<?php 
require_once 'mysql.php';


class Product extends MySql
{
    // get all products

    public function getAll()
    {
        $query = "SELECT * FROM products";

        
        $result = $this->connect()->query($query);
        $products = [];

        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                array_push($products,$row);
            }
        }

        return $products;
    }

    // get  one product

    public function getOne($id)
    {
        $query ="SELECT * FROM products WHERE id ='$id'";

        $result = $this->connect()->query($query);
        $product= null;

        if($result->num_rows ==1)
        {
            $product =$result->fetch_assoc();
        }
        return $product;
    }

    // create new product

    public function store(array $data)
    {
        $data['name']= mysqli_real_escape_string($this->connect(),$data['name']) ;
        $data['desc']= mysqli_real_escape_string($this->connect(),$data['desc']) ;
        $query = "INSERT INTO products (`name`,`desc`,img ,price,quantity,category , created_at)
        VALUE ('{$data['name']}' , '{$data['desc']}' ,'{$data['img']}' , '{$data['price']}' , '{$data['quantity']}', '{$data['category']}',CURRENT_TIME())";

        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;

    }
    
    // edit product

    public function update($id ,array $data)
    {
        $data['name']= mysqli_real_escape_string($this->connect(),$data['name']) ;
        $data['desc']= mysqli_real_escape_string($this->connect(),$data['desc']) ;
        
        $query ="UPDATE products SET
        `name` = '{$data['name']}',
        `desc` = '{$data['desc']}',
        `price` = '{$data['price']}',
        `quantity` = '{$data['quantity']}'
        WHERE id ='$id'
        ";

        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;
    }

    //delete product
    public function delete($id)
    {
        $query ="DELETE FROM products WHERE id ='$id'";
        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;

    }

}

?>

