<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>YII - 管理系统</title>
    <link rel="stylesheet" type="text/css" href="/yii-application/backend/web/assets/jquery-easyui-1.4.1/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/yii-application/backend/web/assets/jquery-easyui-1.4.1/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/yii-application/backend/web/assets/jquery-easyui-1.4.1/themes/color.css">
    <link rel="stylesheet" type="text/css" href="/yii-application/backend/web/assets/jquery-easyui-1.4.1/themes/metro/tree.css">
    <script type="text/javascript" src="/yii-application/backend/web/assets/jquery-easyui-1.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/yii-application/backend/web/assets/jquery-easyui-1.4.1/jquery.easyui.min.js"></script>
    <style type="text/css">
        a:link,a:visited{text-decoration:none; color:#0E84D6;}
        a:hover,a:active{color:#d6630e;}
        #pageheader{overflow:hidden;height: 50px;}
        #pageheader .header_title{float: left;width: 250px;font-size: 18px;color: #9d9d9d;padding: 13px 30px 12px 30px;}
        #pageheader .nav{display: block;height: 25px;float: right;list-style: none;}
        #pageheader .nav li{float:left;margin-left: -1px;padding:15px 10px 10px 10px;line-height:11px;position:relative;color: #aaa;}
        #pageheader .nav li a:link,a:visited{text-decoration:none; color:#555;}
        #pageheader .nav li a:hover,a:active{text-decoration:none; color:#aaa;}
        #systemLogInfo{border: 1px solid #ededed; height: 490px;margin:10px;overflow:hidden;position:relative;}
        #systemLogInfo ul li{border-bottom: 1px dotted #333333;overflow:hidden;padding:20px 0;width:100%;}
        #systemLogInfo ul{left: 0;margin: 10px;padding:0;position:absolute;top: 0;}
    </style>
</head>
<body class="easyui-layout" style="text-align:left">

    <div id="pageheader" data-options="region:'north',border:false" style="background:none repeat scroll 0% 0% #111;">
        <span class="header_title">YII内容管理系统</span>
        <ul class="nav">
            <li>欢迎您：<?php echo Yii::$app->user->identity->username ?></li>
            <li>
              <a href="/yii-application/backend/web/index.php?r=/site/logout"  >注销</a>
            </li>
        </ul>
    </div>

    <div data-options="region:'west',split:true" title="内容管理系统" style="width:220px;">
        <div class="easyui-accordion" data-options="fit:true,border:false" style="">
            <div title="首页" data-options="selected:true" style="">
                <ul class="easyui-tree">
                    <li>
                        <span>前端页面</span>
                         <ul>
                            <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/frontend/web/index.php', '首页')">首页</a></span></li>
                            <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/frontend/web/index.php?r=site/about', '关于')">关于</a></span></li>
                            <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/frontend/web/index.php?r=site/contact', '联系')">联系</a></span></li>
                         </ul>
                    </li>
                </ul>
            </div>
            
            <div title="内容管理"  style="">
                <ul class="easyui-tree">
                    <li>
                        <span>订单管理</span>
                         <ul>
                            <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=order', '订单列表')">订单列表</a></span></li>
                         </ul>
                    </li>
                </ul>
            </div>

            <div title="系统管理" style="">
              <ul class="easyui-tree">
                  <li>
                      <span>角色或权限管理</span>
                       <ul>
                          <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=auth-item', '角色或权限')">角色或权限</a></span></li>
                          <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=auth-item-child', '角色权限关联')">角色权限关联</a></span></li>
                          <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=auth-assignment', '用户角色')">用户角色</a></span></li>
                          <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=auth-rule', '规则')">规则</a></span></li>
                          <li><span><a href="javascript:;" onclick="mainJs.addTab('http://localhost/yii-application/backend/web/index.php?r=user', '用户')">用户</a></span></li>
                       </ul>
                  </li>
              </ul>
            </div>
        </div>
    </div>


    <div data-options="region:'center'">
        <div id="homePageTabs" class="easyui-tabs" data-options="fit:true,border:false,plain:true">

        </div>
    </div>

    <div data-options="region:'south',border:false" style="height:20px;">&copy; My Company 2015, Powerd by Yii</div>

    <script>
    //消息推送javascript模块
    var mainJs = ( function (mod, $){
        mod.addTab = function(url,title){
           if ($('#homePageTabs').tabs('exists', title)){
               $('#homePageTabs').tabs('close', title);
               var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:99%;"></iframe>';
               $('#homePageTabs').tabs('add',{
                   title:title,
                   content:content,
                   closable:true
               });
           } else {
               var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:99%;"></iframe>';
               $('#homePageTabs').tabs('add',{
                   title:title,
                   content:content,
                   closable:true
               });
           }
        };

        mod.wellcomeInit = function(title,url){
           var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:99%;"></iframe>';
           $('#homePageTabs').tabs('add',{
               title:title,
               content:content,
               closable:false
           });
        };

        mod.collapseAll = function(){
            // $('#leftTreeMenu').tree('collapseAll');
        }
         return mod;

    })(window.mainJs || {}, $);

    $(document).ready(
        function(){
            mainJs.wellcomeInit('欢迎界面','/yii-application/frontend/web/index.php');
            mainJs.collapseAll();
        }
    );

    </script>
</body>
</html>