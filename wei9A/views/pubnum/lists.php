<section>
    <h2><strong style="color:grey;">公众号列表</strong></h2>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>公众号名称</th>
            <th>Appid</th>
            <th>Appsecret</th>
            <th>内容</th>
            <th>操作</th>
        </tr>
        <?php foreach($numDate as $key=>$val){?>
        <tr>
            <td><?=$val['id']?></td>
            <td><?=$val['appname']?></td>
            <td><?=$val['appid']?></td>
            <td><?=$val['appsecret']?></td>
            <td><?=$val['appdesc']?></td>
            <td>
                <a href="index.php?r=pubnum/numdel&id=<?=$val['id']?>" class="inner_btn">删除</a>
                <a href="index.php?r=pubnum/numup&id=<?=$val['id']?>" class="inner_btn">修改</a>
            </td>
        </tr>
        <?php }?>
    </table>
    <aside class="paging">
        <a>第一页</a>
        <a>1</a>
        <a>2</a>
        <a>3</a>
        <a>…</a>
        <a>1004</a>
        <a>最后一页</a>
    </aside>
</section>