<?php
class Person{
    private $name;
    private $gender;
    private $age;

    function __construct($name,$gender,$age){
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
    }

    function getName(){
        return $this->name;
    }
}

$wale = new Person("Olawale","Male",23);
echo "My name is {{$wale->getName() }}";