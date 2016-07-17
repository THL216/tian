<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="js/jquery.js"></script>
    <script src="js/verificationNumbers.js"></script>
    <script src="js/Particleground.js"></script>
    <script>
        $(document).ready(function() {

            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //测试提交，对接程序删除即可
            $(".submit_btn").click(function(){
                //alert(123)
                var verify = $(".login_txtbx[name=verify]").val();
                if(verify.toLowerCase() != code.toLowerCase()){
                    alert('验证码有误');return;
                }
                var username = $(".login_txtbx[name=username]").val();
                var password = $(".login_txtbx[name=password]").val();
                $.post('index.php?r=login/index',{u_name:username,pwd:password},function(result){
                    //alert(result);return;
                    if(result==1){
                        location.href="index.php?r=site/index";
                    }else{
                        alert('用户名密码有误');
                    }
                });
            });
            //验证码
            createCode();

        });
    </script>
</head>
<body>
<form action="" method="post">
<dl class="admin_login">
    <dt>
        <strong>WEI 9A 后台管理系统</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="账号" class="login_txtbx" name="username"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" class="login_txtbx" name="password"/>
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx" name="verify">
            <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
        </div>
        <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">
    </dd>
    <dd>
        <input type="button" value="立即登陆" class="submit_btn"/>
    </dd>
    <dd>
        <p>© 2015-2016 DeathGhost 版权所有</p>
        <p>京：1409phpA班</p>
    </dd>
</dl>
</form>
</body>
</html>
