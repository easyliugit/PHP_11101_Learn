<fieldset>

    <legend>目前位置：首頁 > 最新文章區</legend>
    <table id="news">
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%"></td>
        </tr>
        <?php
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;

        $rows=$News->all(['sh'=>1]," limit $start,$div");

        foreach($rows as $row){
        ?>
        <tr>
            <td class="title clo" style="cursor:pointer"><?=$row['title'];?></td>
            <td>
                <span class="summary"><?=mb_substr($row['text'],0,20);?>...</span>
                <span class="full" style='display:none'><?=nl2br($row['text']);?></span>
            </td>
            <td></td>
        </tr>
        <?php 
        }

        ?>
    </table>
    <div>
        <?php 

        if(($now-1)>0){
            $p=$now-1;
            echo "<a href='?do=news&p={$p}'> &lt; </a>";
        }
        
        for($i=1;$i<=$pages;$i++){
            $fontsize=($now==$i)?'24px':'18px';
            echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
        }
        if(($now+1)<=$pages){
            $p=$now+1;
            echo "<a href='?do=news&p={$p}'> &gt; </a>";
        }
        
        ?>
    </div>
</fieldset>

<script>
$(".title").on("click",function(){
    $(this).next().children().toggle()
})

</script>