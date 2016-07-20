<!-- <link type="text/css" rel="stylesheet" href="js/bootstrap.css">
<link type="text/css" rel="stylesheet" href="js/font-awesome.css">
<link type="text/css" rel="stylesheet" href="js/commons.css"> -->

<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/emotions.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.min.js"></script>

<script type="text/javascript">
cookie.prefix = '6e34_';
</script>
<script type="text/javascript">
    var pIndex = 1;
    var currentEntity = null;
    $(function(){
        $('tbody.mlist').sortable({handle: '.icon-move'});
        $('.smlist').sortable({handle: '.icon-move'});
        $('.mlist .hover').each(function(){
            $(this).data('do', $(this).attr('data-do'));
            $(this).data('url', $(this).attr('data-url'));
            $(this).data('forward', $(this).attr('data-forward'));
        });
        $('.mlist .hover .smlist div').each(function(){
            $(this).data('do', $(this).attr('data-do'));
            $(this).data('url', $(this).attr('data-url'));
            $(this).data('forward', $(this).attr('data-forward'));
        });
        $(':radio[name="ipt"]').click(function(){
            if(this.checked) {
                if($(this).val() == 'url') {
                    $('#url-container').show();
                    $('#forward-container').hide();
                } else {
                    $('#url-container').hide();
                    $('#forward-container').show();
                }
            }
        });
        $('#dialog').modal({keyboard: false, show: false});
        $('#dialog').on('hide', saveMenuAction);
    });
    function addMenu() {
        if($('.mlist .hover').length >= 3) {
            return;
        }
        var html = '<tr class="hover">'+
                        '<td>'+
                            '<div>'+
                                '<input type="text" class="span4" value=""> &nbsp; &nbsp; '+
                                '<a href="javascript:;"  title="拖动调整此菜单位置">拖动</a> &nbsp; '+
                                '<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());"  title="设置此菜单动作">动作</a> &nbsp; '+
                                '<a href="javascript:;" onclick="deleteMenu(this)"  title="删除此菜单">删除</a> &nbsp; '+
                                '<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单"  title="添加菜单">添加</a> '+
                            '</div>'+
                            '<div class="smlist"></div>'+
                        '</td>'+
                    '</tr>';
        $('tbody.mlist').append(html);
    }
    function addSubMenu(o) {
        if(o.find('div').length >= 5) {
            return;
        }
        var html = '' +
                '<div style="margin-top:20px;margin-left:80px;background:url("\./assets/img/b.git") no-repeat -245px -545px;">'+
                    '<input type="text" class="span3" name="fu" value=""> &nbsp; &nbsp; '+
                    '<a href="javascript:;"  title="拖动调整此菜单位置">拖动</a> &nbsp; '+
                    '<a href="javascript:;" onclick="setMenuAction($(this).parent());"  title="设置此菜单动作">动作</a> &nbsp; '+
                    '<a href="javascript:;" onclick="deleteMenu(this)"  title="删除此菜单">删除</a> '+
                '</div>';
        o.append(html);
    }
    function deleteMenu(o) {
        if($(o).parent().parent().hasClass('smlist')) {
            $(o).parent().remove();
        } else {
            $(o).parent().parent().parent().remove();
        }
    }
    function setMenuAction(o) {
        if(o == null) return;
        if(o.find('.smlist div').length > 0) {
            return;
        }
        currentEntity = o;
        $('#ipt-url').val($(o).data('url'));
        $('#ipt-forward').val($(o).data('forward'));
        if($(o).data('do') != 'forward') {
            $(':radio').eq(0).attr('checked', 'checked');
        } else {
            $(':radio').eq(1).attr('checked', 'checked');
        }
        $(':radio:checked').trigger('click');
        $('#dialog').modal('show');
    }
    function saveMenu() {
        if($('.span4:text').length > 3) {
            message('不能输入超过 3 个主菜单才能保存.', '', 'error');
            return;
        }
        if($('.span4:text,.span3:text').filter(function(){ return $.trim($(this).val()) == '';}).length > 0) {
            message('存在未输入名称的菜单.', '', 'error');
            return;
        }
        if($('.span4:text').filter(function(){ return $.trim($(this).val()).length > 5;}).length > 0) {
            message('主菜单的名称长度不能超过5个字.', '', 'error');
            return;
        }
        if($('.span3:text').filter(function(){ return $.trim($(this).val()).length > 8;}).length > 0) {
            message('子菜单的名称长度不能超过8个字.', '', 'error');
            return;
        }
        var dat = '[';
        var error = false;
        $('.mlist .hover').each(function(){
            var name = $.trim($(this).find('.span4:text').val()).replace(/"/g, '\"');
            var type = $(this).data('do') != 'forward' ? 'view' : 'click';
            var url = $(this).data('url');
            if(!url) {
                url = '';
            }
            var forward = $.trim($(this).data('forward'));
            if(!forward) {
                forward = '';
            }
            dat += '{"name": "' + name + '"';
            if($(this).find('.smlist div').length > 0) {
                dat += ',"sub_button": [';
                $(this).find('.smlist div').each(function(){
                    var sName = $.trim($(this).find('.span3:text').val()).replace(/"/g, '\"');
                    var sType = $(this).data('do') != 'forward' ? 'view' : 'click';
                    var sUrl = $(this).data('url');
                    if(!sUrl) {
                        sUrl = '';
                    }
                    var sForward = $.trim($(this).data('forward'));
                    if(!sForward) {
                        sForward = '';
                    }
                    // alert(sName);
                    dat += '{"type":"scancode_waitmsg","name": "' + sName + '","key":"rselfmenu_0_0"';
                    // if((sType == 'click' && sForward == '') || (sType == 'view' && !sUrl)) {
                    //     message('子菜单项 “' + sName + '”未设置对应规则.', '', 'error');
                    //     // error = true;
                    //     return false;
                    // }
                    // if(sType == 'click') {
                    //     dat += ',"type": "click","key": "' + encodeURIComponent(sForward) + '"';
                    // }
                    // if(sType == 'view') {
                    //     dat += ',"type": "view","url": "' + sUrl + '"';
                    // }
                    dat += '},';
                });
                // if(error) {

                //     return false;
                // }
                dat = dat.slice(0,-1);
                dat += ']';
            } else {
                // if((type == 'click' && forward == '') || (type == 'view' && !url)) {
                //     message('菜单 “' + name + '”不存在子菜单项, 且未设置对应规则.', '', 'error');
                //     // error = true;
                //     return false;
                // }
                // if(type == 'click') {
                //     dat += ',"type": "click","key": "' + encodeURIComponent(forward) + '"';
                // }
                // if(type == 'view') {
                //     dat += ',"type": "view","url": "' + url + '"';
                // }
            }
            dat += '},';
            
        });
        if(error) {
            alert(error)
           
        }
        dat = dat.slice(0,-1);
        dat += ']';
        var dats=('{"button":'+dat+"}")
        var data=$("#ids").val();
        $("#di").val(data);
        $('#do').val(dats);
        $('#form')[0].submit();
    }
</script>
<style type="text/css">
    .table-striped td{padding-top: 10px;padding-bottom: 10px}
    a{font-size:14px;}
    a:hover, a:active{text-decoration:none; color:red;}
    .hover td{padding-left:10px;}
</style>
<div class="main">
    <div class="form form-horizontal">
    <h2><strong style="color:grey;">编辑和设置自定义菜单。</strong></h2>
    <ul>
        <li>
            <span class="item_name" style="width:120px;">选择用户</span>
            
               
                <!-- 菜单列表开始 -->
                    <table class="tb table-striped">
                    <tbody class="mlist ui-sortable">
                    <tr><select class="select" id="ids">
                        <?php foreach($arr as $key=>$val){?>
                           <option value="<?php echo $val['id']?>"><?php echo $val['appname']?></option>
                        <?php }?>
                        </select></tr>
                    
                <tr class="hover" data-do="forward" data-url="" data-forward="V1001_TODAY_MUSIC">
                    <td>
                        <div>
                            <input type="text" class="span4" value="主菜单1"> &nbsp; &nbsp;
                            <a href="javascript:;"  title="拖动调整此菜单位置">拖动</a> &nbsp;
                            <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());"  title="设置此菜单动作">动作</a> &nbsp;
                            <a href="javascript:;" onclick="deleteMenu(this)"  title="删除此菜单">删除</a> &nbsp;
                            <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" >添加</a>
                        </div>
                        <div class="smlist ui-sortable"> </div>
                     
                    </td>
                </tr>
                <tr class="hover" data-do="view" data-url="" data-forward="">
                    <td>
                        <div>
                            <input type="text" class="span4" value="主菜单2"> &nbsp; &nbsp;
                            <a href="javascript:;"  title="拖动调整此菜单位置">拖动</a> &nbsp;
                            <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());title=设置此菜单动作">动作</a> &nbsp;
                            <a href="javascript:;" onclick="deleteMenu(this)"  title="删除此菜单">删除</a> &nbsp;
                            <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" >添加</a>
                        </div>
                        <div class="smlist ui-sortable"></div>
                    </td>
                </tr>
                </tbody>
        </table>
        <div class="well well-small" style="margin-top:20px;">
            <a href="javascript:;" onclick="addMenu();"><input type="button" class="link_btn" value="添加菜单"> </a>
        </div>
                <!-- 菜单列表结束 -->
            
        </li>

    </ul>


    <table class="tb">
            <tbody>
            <tr><td><br /></td></tr>
                <tr>
                    <td>
                    <input type="button" value="保存菜单结构" class="btn btn-primary span3" onclick="saveMenu();">
                        
                        <span class="help-block">保存当前菜单结构至公众平台</span>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
</div>
<form action="index.php?r=menu/token" method="post" id="form"><input  type="hidden" id="di" name="di"/><input id="do" name="do" type="hidden"></form>

