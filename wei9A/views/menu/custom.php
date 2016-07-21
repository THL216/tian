

<title>wei9A - 微信公众平台自助引擎</title>
<!-- <meta name="keywords" content="微擎,微信,微信公众平台"> -->
<!-- <meta name="description" content="微信公众平台自助引擎，简称微擎，微擎是一款免费开源的微信公众平台管理系统。"> -->
<link type="text/css" rel="stylesheet" href="js/js/bootstrap.css">
<link type="text/css" rel="stylesheet" href="js/js/font-awesome.css">
<link type="text/css" rel="stylesheet" href="js/js/common1.css">
<script type="text/javascript" src="js/js/jquery-1.js"></script>
<script type="text/javascript" src="js/js/bootstrap.js"></script>
<script type="text/javascript" src="js/js/common2.js"></script>
<script type="text/javascript" src="js/js/emotions.js"></script>
<script type="text/javascript">
cookie.prefix = '6e34_';
</script>
<style type="text/css">#kf-content-div a,
#kf-content-div p {
    border: 0px !important;
    padding: 0px !important;
    margin: 0px !important;
}

#kf-wiki-div a:hover,
#kf-content-div a:focus {
    text-decoration: none !important;
}

#kf-wiki-div a {
    text-decoration: none !important;
    color: #0645AD !important;
    background: none repeat scroll 0% 0% transparent !important;
}

#kf-wiki-div dt {
    margin-bottom: 0.1em !important;
    font-weight: bold !important;
}

#kf-wiki-div dd {
    margin-left: 1.6em !important;
    margin-bottom: 0.1em !important;
}

/**************/
#kf-my-add-btn {
    display: none;
    height: 18px;
    width: 18px;
    position: fixed;
    z-index: 2147483647;
    line-height: 18px;
    text-decoration: none;
    font: bold 12px/25px Arial;
    color: rgba(62, 87, 6, 0.53);
    background: -moz-linear-gradient(center top, rgba(165, 205, 78, 1) 0%, rgba(107, 143, 26, 1) 100%);
    opacity: 0.55;
    text-shadow: 1px 1px 1px rgba(255, 255, 255, .22);
    border-radius: 18px;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, .29), inset 1px 1px 1px rgba(255, 255, 255, .44);
    transition: all 0.15s ease;
}

#kf-my-add-btn {
    color: rgba(62, 87, 6, 0.53);
    opacity: 0.55;
}

#kf-my-add-btn:hover {
    color: rgba(62, 87, 6, 1);
    opacity: 1;
}

#kf-add-loading-img {
    display: none;
    height: 24px;
    width: 24px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 2147483647;
    border-radius: 24px;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.29), 1px 1px 1px rgba(255, 255, 255, 0.24) inset;
}

#kf-content-div {
    opacity: 0;
    display: none;
    width: 320px;
    position: fixed;
    right: 20px;
    bottom: -190px;
    z-index: 2147483647;
    font: normal 12px/25px Arial, sans-serif;
    color: #222;
    background: transparent;
}

#kf-top-div {
    height: 40px;
    width: 320px;
    background: rgba(0, 0, 0, .05);
    border-radius: 20px 20px 0px 0px;
    line-height: 40px;
    text-align: center;
}

#kf-wiki-tab {
    width: 160px;
    color: rgba(255, 255, 255, .88);
    text-decoration: none;
    background: rgba(0, 152, 249, .6);
    float: left;
    font-size: 1em;
    border-radius: 20px 20px 0px 0px;
}

#kf-translator-tab {
    width: 160px;
    color: rgba(0, 0, 0, 0.25);
    text-decoration: none;
    background: transparent;
    font-size: 1em;
    float: left;
    border-radius: 20px 20px 0px 0px;
}

#kf-frame-div {
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.33);
    text-align: left;
}

#kf-trans-div{

    font-weight: bold;width:300px;height:auto;background:rgba(233, 233, 233, 1);opacity:.8;padding:10px;max-height:190px;overflow:auto;

}

#kf-wiki-div {
    width: 300px;
    max-height: 190px;
    padding: 10px;
    background: #E9E9E9;
    opacity: 0.8;
    border: 0px;
    overflow: auto;
}

/*******/
.tipso_bubble,.tipso_bubble>.tipso_arrow{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.tipso_bubble{position:absolute;text-align:center;border-radius:6px;z-index:9999;padding:10px}.tipso_style{cursor:help;border-bottom:1px dotted}.tipso_bubble>.tipso_arrow{position:absolute;width:0;height:0;border:8px solid;pointer-events:none}.tipso_bubble.top>.tipso_arrow{border-color:#000 transparent transparent;top:100%;left:50%;margin-left:-8px}.tipso_bubble.bottom>.tipso_arrow{border-color:transparent transparent #000;bottom:100%;left:50%;margin-left:-8px}.tipso_bubble.left>.tipso_arrow{border-color:transparent transparent transparent #000;top:50%;left:100%;margin-top:-8px}.tipso_bubble.right>.tipso_arrow{border-color:transparent #000 transparent transparent;top:50%;right:100%;margin-top:-8px}</style></head>
<body>
<script type="text/javascript" src="js/js/jquery-ui-1.js"></script>
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
                                '<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                                '<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
                                '<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp; '+
                                '<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单"></a> '+
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
                '<div style="margin-top:20px;padding-left:80px;background:url(\'./resource/image/bg_repno.gif\') no-repeat -245px -545px;">'+
                    '<input type="text" class="span3" value=""> &nbsp; &nbsp; '+
                    '<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                    '<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
                    '<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> '+
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
    function saveMenuAction(e) {
        var o = currentEntity;
        var t = $(':radio:checked').val();
        t = t == 'url' ? 'url' : 'forward';
        if(o == null) return;
        $(o).data('do', t);
        $(o).data('url', $('#ipt-url').val());
        $(o).data('forward', $('#ipt-forward').val());
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
                    dat += '{"name": "' + sName + '"';
                    if((sType == 'click' && sForward == '') || (sType == 'view' && !sUrl)) {
                        message('子菜单项 “' + sName + '”未设置对应规则.', '', 'error');
                        error = true;
                        return false;
                    }
                    if(sType == 'click') {
                        dat += ',"type": "click","key": "' + encodeURIComponent(sForward) + '"';
                    }
                    if(sType == 'view') {
                        dat += ',"type": "view","url": "' + sUrl + '"';
                    }
                    dat += '},';
                });
                if(error) {
                    return false;
                }
                dat = dat.slice(0,-1);
                dat += ']';
            } else {
                if((type == 'click' && forward == '') || (type == 'view' && !url)) {
                    message('菜单 “' + name + '”不存在子菜单项, 且未设置对应规则.', '', 'error');
                    error = true;
                    return false;
                }
                if(type == 'click') {
                    dat += ',"type": "click","key": "' + encodeURIComponent(forward) + '"';
                }
                if(type == 'view') {
                    dat += ',"type": "view","url": "' + url + '"';
                }
            }
            dat += '},';
        });
        if(error) {
            return;
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
<section>
<div class="main">
    <div class="form form-horizontal">
        <h2><strong style="color:grey;">编辑和设置自定义菜单</strong></h2>
        
            <span class="item_name" style="width:120px;">选择用户</span>
            <select class="select" id="ids">
                        <?php foreach($arr as $key=>$val){?>
                           <option value="<?php echo $val['id']?>"><?php echo $val['appname']?></option>
                        <?php }?>
                        </select>
        <table class="tb table-striped">
            <tbody class="mlist ui-sortable">
                                    <tr class="hover" data-do="forward" data-url="" data-forward="V1001_TODAY_MUSIC">
                    <td>
                        <div>
                            <input class="span4" value="推荐歌曲" type="text"> &nbsp; &nbsp;
                            <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                            <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                            <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp;
                            <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign"></a>
                        </div>
                        <div class="smlist ui-sortable">
                                                    </div>
                    </td>
                </tr>
                        <tr class="hover" data-do="view" data-url="" data-forward="">
                    <td>
                        <div>
                            <input class="span4" value="菜单" type="text"> &nbsp; &nbsp;
                            <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                            <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                            <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp;
                            <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign"></a>
                        </div>
                        <div class="smlist ui-sortable"></div>
                    </td>
                </tr>
                                    </tbody>
        </table>
        <div class="well well-small" style="margin-top:20px;">
<a href="javascript:;" onclick="addMenu();"><input type="button" class="link_btn" value="添加菜单"> </a>        </div>

        <!-- <h4>操作 <small>设计好菜单后再进行保存操作</small></h4> -->
        <table class="tb">
            <tbody>
                <tr>
                    <td>
                        <input value="保存菜单结构" class="btn btn-primary span3" onclick="saveMenu()" type="button">
                        <span class="help-block">保存当前菜单结构至公众平台</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<form action="index.php?r=menu/token" method="post" id="form"><input id="di" name="di" type="hidden"><input id="do" name="do" type="hidden"></form>
<div id="dialog" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>选择要执行的操作</h3>
    </div>
    <div class="tab-pane" id="url">
        <div class="well">
            <label class="radio inline">
                <input name="ipt" value="url" checked="checked" type="radio"> 链接
            </label>
            <label class="radio inline">
                <input name="ipt" value="forward" type="radio"> 模拟关键字
            </label>
            <hr>
            <div id="url-container">
                <input class="span6" id="ipt-url" value="http://" type="text">
                <span class="help-block">指定点击此菜单时要跳转的链接（注：链接需加http://）</span>
                <span class="help-block"><strong>注意: 由于接口限制. 如果你没有网页oAuth接口权限, 这里输入链接直接进入微站个人中心时将会有缺陷(有可能获得不到当前访问用户的身份信息. 如果没有oAuth接口权限, 建议你使用图文回复的形式来访问个人中心)</strong></span>
            </div>
            <div id="forward-container" class="hide">
                <input class="span6" id="ipt-forward" type="text">
                <span class="help-block">指定点击此菜单时要执行的操作, 你可以在这里输入关键字, 那么点击这个菜单时就就相当于发送这个内容至微擎系统</span>
                <span class="help-block"><strong>这个过程是程序模拟的, 比如这里添加关键字: 优惠券, 那么点击这个菜单是, 微擎系统相当于接受了粉丝用户的消息, 内容为"优惠券"</strong></span>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="rules"></div>
</div>  
</section>
