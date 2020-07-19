<?php
namespace validation;
require_once 'ValidationInterface.php';

class Email implements ValidationInterface {

    private $name;
    private $value;
    public function __construct($name,$value)
    {
        $this->name= $name;
        $this->value= $value;  
    }

    public function validate()
    {
        if(!filter_var($this->value , FILTER_VALIDATE_EMAIL))
        {
            return "$this->name is not a valid email";
        }
        return '';
    }

}

?>