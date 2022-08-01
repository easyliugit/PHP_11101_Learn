<style>
    .type{
        cursor: pointer;
        color:blue;
        margin:1rem 0;
        max-width: max-content;
    }
    .type:hover{
        border-bottom:1px solid blue;
    }
</style>
<div>目前位置：首頁 > 分類網誌 > <span id="header">健康新知</span></div>
<div style="display:flex">
    <fieldset>
        <legend>分類網誌</legend>
        <div class="type">健康新知</div>
        <div class="type">菸害防制</div>
        <div class="type">癌症防治</div>
        <div class="type">慢性病防治</div>
    </fieldset>
    <fieldset>
        <legend>文章列表</legend>
        <div></div>
    </fieldset>
</div>

<script>
$(".type").on("click",function(){
    let type=$(this).text()
    $("#header").text(type)
})
</script>