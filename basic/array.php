<h2>陣列</h2>
<?php
$a=[];

echo var_dump($a);
echo "<hr>";
print_r($a);
echo "<hr>";


$a[1]="A";
$a[5]="B";
$a['大明']=59;
echo var_dump($a);
echo "<hr>";
print_r($a);
echo "<hr>";
echo "<h3>取用方式</h3>";
echo '$a[5] =>'.$a[5];
echo "<br>";
echo '$a[\'大明\']=>'.$a['大明'];


echo "<hr>";

$a=[];
$a[]='泰山';
$a[]='新北';
$a[]='台北';
$a[]='高雄';
$a[]='台中';

echo var_dump($a);
echo "<hr>";
print_r($a);
echo "<hr>";
echo "<h3>取用方式</h3>";

echo '$a[0]=>'.$a[0];
echo "<br>";
echo '$a[1]=>'.$a[1];
echo "<hr>";
//echo $a;
echo serialize($a);
echo "<hr>";
$string='a:5:{s:5:"width";i:1021;s:6:"height";i:286;s:4:"file";s:35:"2017/10/sandwich-e1508821589698.jpg";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:35:"sandwich-e1508821589698-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:34:"sandwich-e1508821589698-300x84.jpg";s:5:"width";i:300;s:6:"height";i:84;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:35:"sandwich-e1508821589698-768x215.jpg";s:5:"width";i:768;s:6:"height";i:215;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:21:"sandwich-1024x614.jpg";s:5:"width";i:1024;s:6:"height";i:614;s:9:"mime-type";s:10:"image/jpeg";}s:32:"twentyseventeen-thumbnail-avatar";a:4:{s:4:"file";s:35:"sandwich-e1508821589698-100x100.jpg";s:5:"width";i:100;s:6:"height";i:100;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}';

echo $string;

echo "<hr>";
$src=unserialize($string);
echo var_dump($src);
echo "<hr>";
echo "<pre>";
print_r($src);
echo "</pre>";

$a=['a','b','c','d','e'];
$b="ssssswsss";
echo '$b=>'. in_array('z',$a);
echo "<br>";
echo '$a=>'. in_array('c',$a);
?>