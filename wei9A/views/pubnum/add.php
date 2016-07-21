<section>
    <h2><strong style="color:grey;"><?php echo isset($numDate) ? '修改' : '添加';?>公众号</strong></h2>
    <form action="" method="post" id="myform" onsubmit="return che_all(true)">
        <ul class="ulColumn2">
            <li>
                <span class="item_name" style="width:120px;">公众号名称：</span>
                <input type="text" class="textbox textbox_295" placeholder="公众号名称..." name="appname" value="<?php echo isset($numDate) ? $numDate['appname']:'';?>"/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <li>
                <span class="item_name" style="width:120px;">Appid：</span>
                <input type="text" class="textbox textbox_295" placeholder="Appid..." name="appid" value="<?php echo isset($numDate) ? $numDate['appid']:'';?>"/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <li>
                <span class="item_name" style="width:120px;">Appsecret：</span>
                <input type="text" class="textbox textbox_295" placeholder="Appsecret..." name="appsecret" value="<?php echo isset($numDate) ? $numDate['appsecret']:'';?>"/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <li>
                <span class="item_name" style="width:120px;">内容：</span>
                <textarea placeholder="内容" class="textarea" style="width:500px;height:100px;" name="appdesc"><?php echo isset($numDate) ? $numDate['appdesc']:'';?></textarea>
            </li>
            <li>
                <span class="item_name" style="width:120px;" ></span>

                <input type="button" value="检测公众号" class="group_btn" id="checkPubnum"/>

                <span  id="checkResult"></span>
            </li>
            <li>
                <span class="item_name" style="width:120px;"></span>
                <input type="submit" class="link_btn"  value="<?php echo isset($numDate) ? '修改' : '添加';?>" id="submit" />
            </li>
        </ul>
    </form>
</section>
<script>
    var app = false;
    $(function () {
        $('.errorTips').hide();

        $('#checkPubnum').click(function(){
            var appid = $("input[name='appid']").val();
            var appsecret = $("input[name='appsecret']").val();
            $.getJSON('index.php?r=pubnum/checkapp&appid='+appid+'&appsecret='+appsecret,function(msg){
                //alert(msg)
                if(!msg){
                    $('#checkResult').html("<span class='errorTips' id='error'>未通过检测，请确认信息后重新检测</span>");
                    $('#error').show();
                    app = false;
                    //$('#submit').attr('disabled','disabled');
                }else{
                    $('#checkResult').html("<img src='./images/ok.png' style='width: 25px;height: 25px'/>");
                    //  $('#submit').removeAttr('disabled');
                    app = true;
                }
            })
        });
        $('#submit').click(function(){
           // $('#checkPubnum').click()
        });
    });
    function che_all(){
        $('#checkPubnum').click();
        if(app){
            return true;
        }
        return false;
    }
</script>