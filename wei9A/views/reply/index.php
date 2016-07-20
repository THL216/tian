<section>
    <h2><strong style="color:grey;">回复列表</strong></h2>

    <table class="table">
        <tr>
            <th>序号</th>
            <th>公众号</th>
            <th>标题</th>
            <th>关键字</th>
            <th>回复内容</th>
            <th>操作</th>
        </tr>
        <?php foreach($arr as $key=>$val){?>
            <tr style="height: 100px">
                <td><?php echo $key+1;?></td>
                <td><?=$val['appname']?></td>
                <td><?=$val['rename']?></td>
                <td><?=$val['rekeyword']?></td>
                <td><?=$val['redesc']?></td>
                <td>
                    <a href="index.php?r=reply/del&id=<?=$val['id']?>" class="inner_btn">删除</a>
                    <a href="index.php?r=reply/upd&id=<?=$val['id']?>" class="inner_btn">修改</a>
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