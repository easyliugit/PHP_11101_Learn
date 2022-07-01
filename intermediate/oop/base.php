<?php
/**為了簡易的資料庫操作所設計的一套資料庫物件操作方法 
 * C - insert($array)
 * R - find($id) ,all(...arg),q($sql),math($col,$math,...$arg)
 * U - update($array)
 * D - del($id)
*/

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=students";
    protected $user='root';
    protected $pw='';
    protected $table='';
    protected $pdo;

    public function __construct($table)
    {
            $this->table=$table;
            $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }

    protected function array_str($array){
        foreach($array as $key => $value){
            if($key!='id'){
                $tmp[]="`$key`='$value'";
            }
        }

        return $tmp;
    }

    public function find($id){
        $sql="SELECT * FROM $this->table ";

        if(is_array($id)){
            
            $tmp=$this->array_str($id);

            $sql = $sql ." WHERE ". join(" AND ",$tmp);

        }else{

            $sql = $sql . " WHERE `id` = '$id'";

        }

        //echo $sql;

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    
    public function all(...$arg){
        $sql="SELECT * FROM $this->table ";

        if(!empty($arg[0])){

            if(is_array($arg[0])){

                $tmp=$this->array_str($arg[0]);
    
                $sql = $sql ." WHERE ". join(" AND ",$tmp);
            }else{

                $sql = $sql .$arg[0];
            }

        }

        if(!empty($arg[1])){
            $sql = $sql . $arg[1];
        }
       // echo $sql;

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function save($array){      
        if(isset($array['id'])){
            //update
            $tmp=$this->array_str($array);
            $sql="update $this->table set ". join(",",$tmp) ." where `id`='{$array['id']}'";
        }else{
            //insert
            $sql="INSERT into $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    function del($id){

        $sql="DELETE FROM $this->table WHERE ";

        if(is_array($id)){

            $tmp=$this->array_str($id);

            $sql = $sql . join(" AND ",$tmp);

        }else{

            $sql = $sql . " `id` = '$id'";

        }
        return $this->pdo->exec($sql);
    }

    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function math($math,$col,...$arg){
        $sql="SELECT $math(`$col`) FROM $this->table ";
              
        if(!empty($arg[0])){

            if(is_array($arg[0])){

                $tmp=$this->array_str($arg[0]);
    
                $sql = $sql ." WHERE ". join(" AND ",$tmp);
            }else{

                $sql = $sql .$arg[0];
            }

        }

        if(!empty($arg[1])){
            $sql = $sql . $arg[1];
        }
       // echo $sql;

        return $this->pdo->query($sql)->fetchColumn();
    }
}


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

class Room extends DB{

    public function __construct()
    {
        $this->table='classes';
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }
}


$Dept=new DB('dept');

echo $Dept->math('max','id');

/* $Dept->del(['name'=>'森林維護科']); */

//echo $Dept->insert(['code'=>'701','name'=>'服裝設計科']);
 //$dept=$Dept->find(['code'=>'404']);

/*$dept['name']='森林維護科';
dd($dept);
$Dept->update($dept); */

//$Class=new Room;
/* $Dept=new DB('dept');
$ClassStudents=new DB('class_student'); */
//$class=$Class->all();
// dd($class);
//$dept=$Dept->all();

/* $class_studs=$ClassStudents->all(['class_code'=>101]," limit 10");
dd($class_studs);
$class_studs=$ClassStudents->all(['class_code'=>101]);
dd($class_studs);
$class_studs=$ClassStudents->all(" limit 10,20");
dd($class_studs);
$class_studs=$ClassStudents->all("where `seat_num` <= 10 "," limit 10,20");
dd($class_studs); */

/*dd($dept); */


?>