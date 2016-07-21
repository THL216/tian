

<form action="index.php?r=menu/del" method="post"><span class="item_name" style="width:120px;">选择用户</span><select class="select" name="id" id="">
       <?php foreach($arr as $k=>$v){  ?>
        <option value="<?php echo $v['id'] ?>"><?php echo $v['appname'] ?></option>
        <?php } ?>
     </select><br />
     <input class="link_btn" type="submit" value="删除" >
     </form>