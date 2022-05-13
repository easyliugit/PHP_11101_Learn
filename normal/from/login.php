<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入檢查</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        #wrapper {
            height: 250px;
        }

        .btn {
            width: 49%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <header>
            <p>會員登入</p>
        </header>
        <div id="content">
            <form action="chklogin.php" method="post">
                <div class="form-group">
                    <input class="form-control" placeholder="帳號" name="acc" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="密碼" name="pw" type="password">
                </div>
                <button type="reset" class="btn"> 重置</button>
                <button type="submit" class="btn"> 登入</button>
            </form>
        </div>
    </div>

</body>

</html>