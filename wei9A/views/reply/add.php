<section>
    <h2><strong style="color:grey;"><?php echo isset($numDate) ? '修改' : '添加';?>回复规则</strong></h2>
    <form action="index.php?r=reply/add" method="post" >
        <input type="hidden" name="id" value="<?php echo isset($numDate) ? $numDate['id']:'';?>"/>
        <ul class="ulColumn2">
            <li>
                <span class="item_name" style="width:120px;">选择公众号</span>
                <select class="select" name="appid" >
                    <?php foreach($data as $k=>$v){
                        if(isset($numDate)){
                        if($v['appid'] == $numDate['appid']){ ?>
                            <option value="<?php echo $v['id']?> selected "><?php echo $v['appname']?></option>
                            <?php }else{?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['appname']?></option>
                    <?php }}else{?>

                    <option value="<?php echo $v['id']?>"><?php echo $v['appname']?></option>

                  <?php  } }?>
                </select>
            </li>
            <li>
                <span class="item_name" style="width:120px;">标题</span>
                <input type="text" class="textbox textbox_295" placeholder="rename..." name="rename" value="<?php echo isset($numDate) ? $numDate['rename']:'';?>"/>
            </li>
            <li>
                <span class="item_name" style="width:120px;">关键字</span>
                <input type="text" class="textbox textbox_295" placeholder="rekeyword..." name="rekeyword" value="<?php echo isset($numDate) ? $numDate['rekeyword']:'';?>"/>
            </li>
            <li>
                <span class="item_name" style="width:120px;">回复内容：</span>
                <textarea placeholder="内容" class="textarea" style="width:500px;height:100px;" name="redesc"><?php echo isset($numDate) ? $numDate['redesc']:'';?></textarea>
            </li>
            <li>
                <span class="item_name" style="width:120px;"></span>
                <input type="submit" class="link_btn"  value="<?php echo isset($numDate) ? '修改' : '添加';?>" />
            </li>
        </ul>
    </form>
</section>
