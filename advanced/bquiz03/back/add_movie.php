<h3 class="ct">新增院線片</h3>
<form action="./api/add_movie.php" method="post" enctype="multipart/form-data">
<table style="width:75%;margin:auto">
    <tr>
        <td>影片資料</td>
        <td>
            <div><label>片名:</label><input type="text" name="name"></div>
            <div><label>分級:</label>
                <select name="level">
                    <option value="普遍級">普遍級</option>
                    <option value="輔導級">輔導級</option>
                    <option value="保護級">保護級</option>
                    <option value="限制級">限制級</option>
                </select>
            </div>
            <div><label>片長:</label><input type="number" name="length"></div>
            <div><label>上映日期:</label>
            <select name="year" >
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>年
            <select name="month">
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
            </select>月
            <select name="day">
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
            <div><label>發行商:</label><input type="text" name="publish"></div>
            <div><label>導演:</label><input type="text" name="director"></div>
            <div><label>預告影片:</label><input type="file" name="trailer"></div>
            <div><label>電影海報:</label><input type="file" name="poster"></div>
        </td>
    </tr>
    <tr>
        <td>劇情簡介</td>
        <td><textarea name="intro" style="width:98%;height:60px"></textarea></td>
    </tr>
</table>
<div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>