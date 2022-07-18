<?php
$type=$_POST['type'];
?>
<?php
if($type=='add'){
  echo "<h3>新增學員</h3>";
  
}else{
  echo "<h3>編輯學員</h3>";

}
?>
    <form method="post">
      <p>班級:<input type="number" name="classroom" id="classroom"></p>
      <p>座號:<input type="number" name="seatnum" id="seatnum"></p>
      <p>姓名:<input type="text" name="name" id="name"></p>
      <p>生日:<input type="date" name="birthday" id="birthday"></p>
      <p>
        <?php
        if($type=='edit'){
          echo "<input type='hidden' name='id' id='stuId' value=''>";
        }

        ?>
        <?php
        if($type=='add'){

          echo "<input type='button' class='btn btn-primary' value='確認新增' onclick='create()'>";
        }else{
          echo "<input type='button' class='btn btn-primary' value='確認編輯' onclick='update()'>";

        }
        ?>
        <input type="button" class='btn btn-warning' value="取消" onclick="$('.modal-body').html('');$('#stuModal').modal('hide')">
      </p>
    </form>