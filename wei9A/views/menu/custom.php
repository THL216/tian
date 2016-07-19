<section>
    <h2><strong style="color:grey;">分列内容布局</strong></h2>
    <ul>
        <li>
            <span class="item_name" style="width:120px;">选择微信号</span>
            <select class="select">
               <?php foreach($arr as $key=>$val){?>
                   <option value="<?php echo $val['uid']?>"><?php echo $val['appname']?></option>
                <?php }?>
            </select>
        </li>

    </ul>
</section>