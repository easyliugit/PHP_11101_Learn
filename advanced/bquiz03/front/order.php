<?php  $selectedMovieId=$_GET['id']??0 ;?>
<div id="order">

    <h2 class="ct">線上訂票</h2>
    
    <table style="width:500px;margin:auto">
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
        <button onclick="booking()">確定</button>
        <button>重置</button>
    </div>
</div>

<div id="booking" style="display:none">
劃位

</div>

<script>

    let info={
        movieId:0,
        movieName:'',
        date:'',
        sessionId:0,
        session:'',
        seats:null,
    }

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
        $("#session").load("./api/session_list.php",{movie,date},()=>{

        })
    }

    function booking(){
        $("#order").hide();
        $("#booking").show();
        updateInfo()
        $.get("./api/get_booking.php",{movie:info.movieName,date:info.date,session:info.session},(seats)=>{
            $("#booking").html(seats)
            setSeatEvents()
        })
    }

    function updateInfo(){
        info.movieId=$("#movie").val()
        info.movieName=$("#movie option:selected").text()
        info.date=$("#date").val()
        info.sessionId=$("#session").val()
        info.session=$("#session option:selected").text().split(" ")[0]
    }

    function setSeatEvents(){
        let seats=new Array();
        $("#movieName").text(info.movieName)
        $("#dateStr").text(info.date)
        $("#sessionName").text(info.session)
            
            
        $(".seat input").on("change",function(){
            let num=$(this).val()

            if($(this).prop('checked')){
                if(seats.length>=4){
                    alert("最多只能勾選四張票")
                    $(this).prop('checked',false)
                }else{
                    seats.push(num)
                    $(this).parent().removeClass("empty")
                    $(this).parent().addClass("checked")
                }
            }else{
                seats.splice(seats.indexOf(num),1);
                $(this).parent().removeClass("checked")
                $(this).parent().addClass("empty")
            }
            
            $("#tickets").text(seats.length)

            })
        info.seats=seats;
    }

</script>