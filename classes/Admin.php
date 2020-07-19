<?php

require_once 'mysql.php';


class Admin extends MySql
{
    public function attempt($email,$hashed_password)
    {
        $query = "SELECT *FROM admins 
        WHERE email = '$email' AND `password` = '$hashed_password' " ;

        $result = $this->connect()->query($query);
        $user = NULL ;

        if($result->num_rows ==1)
        {
            $user =$result->fetch_assoc();
        }
        return $user;
    }
}



?>