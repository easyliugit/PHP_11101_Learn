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

class Animal{
    public $name="小英";
    protected $emotion="快樂";
    private $food="罐罐";

    public function __construct($name)
    {
        $this->name=$name;
    }
}

class Cat extends Animal{


}

$cat=new Cat('阿中');
$dog=new Cat('阿華');
$lion=new Cat('阿國');

echo $cat->name;
echo $dog->name;
echo $lion->name;



?>
</body>
</html>