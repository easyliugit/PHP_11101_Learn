// 動態新增欄位id編號預設值
let liId = 1;
                
// 動態新增欄位
$("#btn_add_option").click(function () {
    $("#add_options").append('<li id="li_add' + liId + '"><input type="text" name="o_option_add[]"><input type="button" id="btn_del_option" value="刪除選項" onclick="delOption_add(' + liId + ')"></li>');
    liId++;
});

// 動態刪除欄位
function delOption_add(id) {
    $("#li_add" + id).remove();
}