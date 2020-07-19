<?php 
require_once 'mysql.php';


class OrderDetails extends MySql
{
    // get all OrderDetails

    public function getAll()
    {
        $query = "SELECT * FROM `order_details`";

        
        $result = $this->connect()->query($query);
        $OrderDetails = [];

        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                array_push($OrderDetails,$row);
            }
        }

        return $OrderDetails;
    }

    // get  one OrderDetails

    public function getOne($id)
    {
        $query ="SELECT * FROM `order_details` WHERE `order_id` = '$id';";

        $result = $this->connect()->query($query);
        $OrderDetails = null;

        if($result->num_rows == 1)
        {
            $OrderDetails =$result->fetch_assoc();
        }
        return $OrderDetails;
    }

    // create new order

    public function store(array $data)
    {
        $data['product_id']= mysqli_real_escape_string($this->connect(),$data['product_id']) ;
        $data['order_id']= mysqli_real_escape_string($this->connect(),$data['order_id']) ;
        $data['	priceEach']= mysqli_real_escape_string($this->connect(),$data['	priceEach']) ;
        
        $query = "INSERT INTO `order_details` (`product_id`, `order_id`, `priceEach`)
        VALUE ('{$data['product_id']}' , '{$data['order_id']}' ,'{$data['priceEach']}')";

        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;

    }

}

?>

