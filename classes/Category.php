<?php


require_once 'mysql.php';


class Category extends MySql
{
    // get all Category

    public function getAll()
    {
        $query = "SELECT * FROM categories";

        
        $result = $this->connect()->query($query);
        $categories = [];

        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                array_push($categories,$row);
            }
        }

        return $categories;
    }

    // get  one category

    public function getOne($id)
    {
        $query ="SELECT * FROM categories WHERE category_id ='$id'";

        $result = $this->connect()->query($query);
        $category= null;

        if($result->num_rows ==1)
        {
            $category =$result->fetch_assoc();
        }
        return $category;
    }

    // create new category

    public function store(array $data)
    {
        $data['type']= mysqli_real_escape_string($this->connect(),$data['type']) ;
       
        $query = "INSERT INTO categories (`type`)
        VALUE ('{$data['type']}')";

        $result = $this->connect()->query($query);
        if($result == true)
        {
            return true;
        }
        return false;

    }
    

}

?>