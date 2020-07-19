<?php 
require_once 'mysql.php';


class Order extends MySql
{
    // get all orders

    public function getAll()
    {
        $query = "SELECT * FROM orders";

        
        $result = $this->connect()->query($query);
        $orders = [];

        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                array_push($orders,$row);
            }
        }

        return $orders;
    }

    // get  one order

    public function getOne($customerEmail)
    {
        $query ="SELECT * FROM orders WHERE customerEmail ='$customerEmail'";

        $result = $this->connect()->query($query);
        $order= null;

        if($result->num_rows ==1)
        {
            $order =$result->fetch_assoc();
        }
        return $order;
    }

    // create new order

    public function store(array $data)
    {
        $data['customerName']= mysqli_real_escape_string($this->connect(),$data['customerName']) ;
        $data['customerEmail']= mysqli_real_escape_string($this->connect(),$data['customerEmail']) ;
        $data['customerAddress']= mysqli_real_escape_string($this->connect(),$data['customerAddress']) ;
        $query = "INSERT INTO orders (customerName,customerEmail,customerPhone ,customerAddress)
        VALUE ('{$data['customerName']}' , '{$data['customerEmail']}' ,'{$data['customerPhone']}' , '{$data['customerAddress']}')";

        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;

    }

}

?>

