<?php  $selectedMovieId=$_GET['id']??0 ;?>

<h2 class="ct">線上訂票</h2>

<table id="order" style="width:500px;margin:auto">
    <tr>
        <td width="15%">電影：</td>
        <td>
            <select name="movie" id="movie"></select>
        </td>
    </tr>
    <tr>
        <td>日期：</td>
        <td>
        <select name="date" id="date"></select>
        </td>
    </tr>
    <tr>
        <td>場次：</td>
        <td>
        <select name="session" id="session"></select>
        </td>
    </tr>
</table>
<div class="ct">
    <button>確定</button>
    <button>重置</button>
</div>

<script>
    $("#movie").load("./api/movie_list.php",{id:<?=$selectedMovieId;?>},()=>{
        let movie=$("#movie").val();
        getDate(movie)
    })

    $("#movie").on('change',function(){
        let movie=$(this).val();
        getDate(movie)

    })

    $("#date").on('change',function(){
        let movie=$("#movie").val();
        let date=$(this).val();
        getSession(movie,date)
    })

    function getDate(movie){

        $("#date").load("./api/date_list.php",{movie},()=>{
            let date=$("#date").val()
            getSession(movie,date)
        })
    }

    function getSession(movie,date){
        console.log(movie,date);
        $("#session").load("./api/session_list.php",{movie,date},()=>{

        })
    }

</script>