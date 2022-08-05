<div style="height:300px;">
<div class="ct">預告片清單</div>
</div>
<hr>
<div style="height:180px;">
<div class="ct">新增預告片海報</div>
<form action="./api/add_poster.php" method="post" enctype="multpart/form-data">
<table style="width:80%;margin:auto">
    <tr>
        <td>預告片海報</td>
        <td><input type="file" name="img" id=""></td>
        <td>預告片片名</td>
        <td><input type="text" name="name" id=""></td>
    </tr>
</table>
<div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>
</div>