<?php

namespace validation;

require_once 'Email.php';
require_once 'Image.php';
require_once 'Max.php';
require_once 'Numeric.php';
require_once 'Required.php';
require_once 'RequiredImage.php';
require_once 'String.php';
require_once 'ValidationInterface.php';

class Validator {

    public $errors =[];

    private function makeValidation(ValidationInterface $v)
    {
        return $v-> validate();
    }

    public function rules($name, $value , array $rules)
    {
        foreach($rules as $rule)
        {
            if($rule == 'required')
            {
                $error = $this->makeValidation(new Required($name,$value));
            }
            else if($rule == 'string')
            {
                $error = $this->makeValidation(new Str($name,$value));
            }
            else if($rule == 'numeric')
            {
                $error = $this->makeValidation(new Numeric($name,$value));
            }
            else if($rule == 'email')
            {
                $error = $this->makeValidation(new Email($name,$value));
            }
            else if($rule == 'max:100')
            {
                $error = $this->makeValidation(new Max($name,$value));
            }
            else if($rule == 'required-image')
            {
                $error = $this->makeValidation(new RequiredImage($name,$value));
            }
            else if($rule == 'image')
            {
                $error = $this->makeValidation(new Image($name,$value));
            }
            else
            {
                $error ='';
            }

            if($error !=='')
            {
                array_push($this->errors , $error);
            }
        }
    }


}



?>