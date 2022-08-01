<fieldset>

    <legend>目前位置：首頁 > 人氣文章區</legend>
    <table id="pop">
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%">人氣</td>
        </tr>
        <?php
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;

        $rows=$News->all(['sh'=>1]," order by good desc limit $start,$div");

        foreach($rows as $row){
        ?>
        <tr>
            <td class="title clo" style="cursor:pointer"><?=$row['title'];?></td>
            <td class="pop">
                <span class="summary"><?=mb_substr($row['text'],0,20);?>...</span>
                
                <div class="modal">
                    <?=nl2br($row['text']);?>
                </div>
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
    </table>
</fieldset>
<script>
$(".title,.pop").hover(
    function (){
        $(this).parent().find('.modal').show()
    },
    function (){
        $(this).parent().find('.modal').hide()
    }
)


/* $(".title").hover(
    function (){
        $(this).next().children('.modal').show()
    },
    function (){
        $(this).next().children('.modal').hide()
    }
)
$(".pop").hover(
    function (){
        $(this).children('.modal').show()
    },
    function (){
        $(this).children('.modal').hide()
    }
)
 */
</script>