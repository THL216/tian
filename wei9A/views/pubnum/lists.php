<section>
    <h2><strong style="color:grey;">公众号列表</strong></h2>

    <table class="table">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>url</th>
            <th>token</th>
            <th>操作</th>
        </tr>
        <?php foreach($numDate as $key=>$val){?>
        <tr style="height: 100px">
            <td><?php echo $key+1;?></td>
            <td><?=$val['appname']?></td>
            <td><?=$val['appurl']?></td>
            <td><?=$val['apptoken']?></td>
            <td>
                <a href="index.php?r=pubnum/numdel&id=<?=$val['id']?>" class="inner_btn">删除</a>

                <a href="index.php?r=pubnum/numup&id=<?=$val['id']?>" class="inner_btn">修改</a>
                <a href="http://mp.weixin.qq.com/debug/cgi-bin/sandboxinfo?action=showinfo&t=sandbox/index"  target="_blank" class="inner_btn">在公众平台修改接口配置</a>
            </td>
        </tr>
        <?php }?>
    </table>
    <aside class="paging">
        <a>第一页</a>
        <a>1</a>
        <a>最后一页</a>
    </aside>
</section>