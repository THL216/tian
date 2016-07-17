<!--tabStyle-->
<script>
    $(document).ready(function(){
        //tab
        $(".admin_tab li a").click(function(){
            var liindex = $(".admin_tab li a").index(this);
            $(this).addClass("active").parent().siblings().find("a").removeClass("active");
            $(".admin_tab_cont").eq(liindex).fadeIn(150).siblings(".admin_tab_cont").hide();
        });
    });
</script>

<section>
    <ul class="admin_tab">
        <li><a class="active">自定义标题</a></li>
        <li><a>自定义标题</a></li>
        <li><a>...可追加</a></li>
    </ul>
    <!--tabCont-->
    <div class="admin_tab_cont" style="display:block;">
        <!--左右分栏：左侧栏目-->
        <div class="cont_col_lt mCustomScrollbar" style="height:500px;">
            <table class="table fl">
                <tr>
                    <th>角色</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td class="center">顶级管理员</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
                <tr>
                    <td class="center">采购人员</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
            </table>
            <table class="table fl" style="margin-top:8px;">
                <tr>
                    <th>角色</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td class="center">顶级管理员</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
                <tr>
                    <td class="center">采购人员</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
            </table>
        </div>
        <!--左右分栏：右侧栏-->
        <div class="cont_col_rt">
            <table class="table fl">
                <tr>
                    <th>资源</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td class="center">测试</td>
                    <td>数据信息过多（扩展性太大），不建议使用此布局，以免数据溢出。</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
                <tr>
                    <td class="center">测试</td>
                    <td>数据信息过多（扩展性太大），不建议使用此布局，以免数据溢出。</td>
                    <td class="center"><a class="inner_btn">DeathGhost</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="admin_tab_cont">tabContent02，内容根据具体数据二次单独定义，公共样式单独调用</div>
    <div class="admin_tab_cont">可追加</div>
</section>
<!--结束：以下内容则可删除，仅为素材引用参考-->