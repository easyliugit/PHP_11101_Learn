<fieldset>
    <legend>帳號管理</legend>
    <table>
        <tr>
            <td class="clo">帳號</td>
            <td class="clo">密碼</td>
            <td class="clo">刪除</td>
        </tr>
    <tbody id="users">
    </tbody>
    </table>
    <div class="ct">
        <button onclick="del()">確定刪除</button>
        <button onclick="$('table input').prop('checked',false)">清空選取</button>
    </div>
</fieldset>


<script>
$.get("./api/users.php",(users)=>{
    $("#users").html(users)
})
function del(){
    let ids=new Array();
    $("table input[type='checkbox']:checked").each((idx,box)=>{
        ids.push($(box).val())
    })
    $.post("./api/del_user.php",{del:ids},()=>{
        $.get("./api/users.php",(users)=>{
            $("#users").html(users)
        })
    })
}
</script>