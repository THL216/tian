<section>
    <h2><strong style="color:grey;">添加公众号</strong></h2>
    <form action="" method="post">
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
                <span class="item_name" style="width:120px;"></span>
                <input type="submit" class="link_btn" value="<?php echo isset($numDate) ? '修改' : '添加';?>"/>
            </li>
        </ul>
    </form>
</section>
<script>
    $(function () {
        $('.errorTips').hide();
    })
</script>