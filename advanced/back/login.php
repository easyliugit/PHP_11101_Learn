<?php
if(!empty($_POST)){
    if($_POST['acc']=='admin'  && $_POST['pw']=='1234'){
        $_SESSION['login']=1;
        to("back.php");
    }else{
        $error="帳號或密碼錯誤";
    }
}

?>
<h3 style="color:red" class='ct'><?=(isset($error))?$error:'';?></h3>
<form action="back.php" method='post'>
<table style="width:30%;margin:auto">
    <tr>
        <td>帳號:</td>
        <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td>密碼:</td>
        <td><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td colspan="2" class="ct"><input type="submit" value="送出"></td>
    </tr>
</table>
</form>