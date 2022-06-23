<form action="./api/add_vote.php" method="post">
    <div>
        <select name="types" id="types">
        <?php
            //從資料表中取出全部的分類
            $types=all("types");

            //使用回圈將分類逐一顯示在畫面上
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
        <!--每當點擊新增選項按鈕時會去執行一次more()這個javascript函式-->
        <input type="button" value="新增選項" onclick="more()">
    </div>
    <div id="selector">
        <!--在input後加上checked可以讓選項成為勾選狀態-->
        <input type="radio" name="multiple" value="0" checked>
        <label>單選</label>
        <input type="radio" name="multiple" value="1" >
        <label>複選</label>
    </div>
    <div id="options">
        <div>
                                <!--當輸入的項目為多項時,記得name的屬性要以陣列方式使用-->
            <label>選項:</label><input type="text" name="option[]">
        </div>
    </div>
    <input type="submit" value="新增">

</form>
<script>
//建立一個javascript自訂函式來增加項
function more(){
    //宣告一個項目的標籤組合字串
    let opt=`<div><label>選項:</label><input type="text" name="option[]"></div>`;
    //取得畫面上id為options的標籤所有html內容
    let opts=document.getElementById('options').innerHTML;

    //在所有標籤內容後面加上宣告的字串
    opts=opts+opt;

    //將組合完成的新字串放回指定id的標籤中
    document.getElementById('options').innerHTML=opts;
}
</script>