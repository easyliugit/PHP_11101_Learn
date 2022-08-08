<?php
$row=$Movie->find($_GET['id']);
$year=(int)explode('-',$row['ondate'])[0];
$month=(int)explode('-',$row['ondate'])[1];
$day=(int)explode('-',$row['ondate'])[2];
?>
<h3 class="ct">編輯院線片</h3>
<form action="./api/edit_movie.php" method="post" enctype="multipart/form-data">
<table style="width:75%;margin:auto">
    <tr>
        <td>影片資料</td>
        <td>
            <div><label>片名:</label><input type="text" name="name" value="<?=$row['name'];?>"></div>
            <div><label>分級:</label>
                <select name="level">
                    <option value="普遍級" <?=($row['level']=='普遍級')?'selected':'';?>>普遍級</option>
                    <option value="輔導級" <?=($row['level']=='輔導級')?'selected':'';?>>輔導級</option>
                    <option value="保護級" <?=($row['level']=='保護級')?'selected':'';?>>保護級</option>
                    <option value="限制級" <?=($row['level']=='限制級')?'selected':'';?>>限制級</option>
                </select>
            </div>
            <div><label>片長:</label><input type="number" name="length" value="<?=$row['length'];?>"></div>
            <div><label>上映日期:</label>
            <select name="year" >
                <option value="2022" <?=($year==2022)?'selected':'';?>>2022</option>
                <option value="2023" <?=($year==2023)?'selected':'';?>>2023</option>
                <option value="2024" <?=($year==2024)?'selected':'';?>>2024</option>
            </select>年
            <select name="month">
                <option value="1"  <?=($month==1)?'selected':'';?>>1</option>
                <option value="2"  <?=($month==2)?'selected':'';?>>2</option>
                <option value="3"  <?=($month==3)?'selected':'';?>>3</option>
                <option value="4"  <?=($month==4)?'selected':'';?>>4</option>
                <option value="5"  <?=($month==5)?'selected':'';?>>5</option>
                <option value="6"  <?=($month==6)?'selected':'';?>>6</option>
                <option value="7"  <?=($month==7)?'selected':'';?>>7</option>
                <option value="8"  <?=($month==8)?'selected':'';?>>8</option>
                <option value="9"  <?=($month==9)?'selected':'';?>>9</option>
                <option value="10" <?=($month==10)?'selected':'';?>>10</option>
                <option value="11" <?=($month==11)?'selected':'';?>>11</option>
                <option value="12" <?=($month==12)?'selected':'';?>>12</option>
            </select>月
            <select name="day">
                <?="<option value='{$day}'>{$day}</option>";?>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>日
            </div>
            <div><label>發行商:</label><input type="text" name="publish" value="<?=$row['publish'];?>"></div>
            <div><label>導演:</label><input type="text" name="director" value="<?=$row['director'];?>"></div>
            <div><label>預告影片:</label><input type="file" name="trailer"></div>
            <div><label>電影海報:</label><input type="file" name="poster"></div>
        </td>
    </tr>
    <tr>
        <td>劇情簡介</td>
        <td><textarea name="intro" style="width:98%;height:60px"><?=$row['intro'];?></textarea></td>
    </tr>
</table>
<div class="ct">
    <input type="hidden" name="id" value="<?=$row['id'];?>">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
</div>
</form>