<form action="./api/add_vote.php" method="post">
    <div>
        <select name="types" id="types">
        <?php
            $types=all("types");
            foreach($types as $type){
                echo "<option value='{$type['id']}'>";
                echo $type['name'];
                echo "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="subject">投票主題：</label>
        <input type="text" name="subject" id="subject">
        <input type="button" value="新增選項" onclick="more()">
    </div>
    <div id="selector">
        <input type="radio" name="multiple" value="0" checked>
        <label>單選</label>
        <input type="radio" name="multiple" value="1" >
        <label>複選</label>
    </div>
    <div id="options">
        <div>
            <label>選項:</label><input type="text" name="option[]">
        </div>
    </div>
    <input type="submit" value="新增">

</form>
<script>
    function more(){
        let opt=`<div><label>選項:</label><input type="text" name="option[]"></div>`;
        let opts=document.getElementById('options').innerHTML;
        opts=opts+opt;
        document.getElementById('options').innerHTML=opts;
    }
</script>