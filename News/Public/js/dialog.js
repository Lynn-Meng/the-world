/**
 * Created by if-information on 2017/8/21.
 */
var dialog = {
    error:function (result) {
        layer.open({
            icon:2,
            title:'错误提示',
            content:result
        })
    },
    success:function (result,url) {
        layer.open({
            icon:1,
            title:'成功提示',
            content:result,
            yes:function () {
                location.href = url;
            }
        })
    }
};