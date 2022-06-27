<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 物件導向</title>
</head>
<body>
<?php

interface Voice{
    public function bray();
    public function roar();
}

class Animal{
    public $name="小英";
    protected $emotion="快樂";
    private $food="罐罐";

    public function __construct($name)
    {
        $this->name=$name;
    }


    public function sayName(){
        echo "你好，我是".$this->name."很高興認識你<br>";
    }

}

class Cat extends Animal implements Voice{
   private $habit="每天吃三餐";


   public function getHabit(){
        echo $this->habit;
   }
   public function setHabit($habit){
        $this->habit=$habit;
   }

   public function sayName(){
    echo "很高興認識你!我是".$this->name."<br>";
    }

    public function bray(){
        echo "meow";
    }
    public function roar(){
        
    }
}
class Dog extends Animal implements Voice{
   private $habit="每天吃三餐";


   public function getHabit(){
        echo $this->habit;
   }
   public function setHabit($habit){
        $this->habit=$habit;
   }

   public function sayName(){
    echo "很高興認識你!我是".$this->name."<br>";
    }

    public function bray(){
        echo "汪";
    }

    public function roar(){

    }
}

$cat=new Cat('阿中');
$dog=new Dog('阿華');
$lion=new Animal('阿國');

$cat->bray();
$dog->bray();
//$lion->bray();

/* $cat->setHabit('午餐不吃要減肥<br>');
echo $cat->getHabit();
echo $cat->sayName();    
echo $dog->getHabit();
echo $lion->sayName(); */



?>
</body>
</html>