<form action="../api/add_vote.php" method="post">
    <div>
        <label for="subject">投票主題：</label>
        <input type="text" name="subject" id="subject">
        <input type="button" value="新增選項" onclick="more()">
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