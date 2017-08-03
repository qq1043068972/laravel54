

layui.use(['layer', 'form'], function(){
    var layer = layui.layer
        ,form = layui.form();

    //layer.msg('Hello World');
});

var dialog = {
        confirmDel:function (jumpUrl) {
            layer.confirm('您确定要删除吗？', {
                btn: ['狠心删除','等一下'] //按钮
            }, function(){
                window.location.href = jumpUrl;
            }, function(){

            });
        }
};