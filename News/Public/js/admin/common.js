/**
 * Created by if-information on 2017/8/22.
 */

$('#button-add').click(function () {
    window.location.href = SCOPE.add_url;
});
$('#cms-button-submit').click(function () {
    var data = {};
    //获取到前台界面的表单数据:
    var  dataArray = $('#cms-form').serializeArray();
    $.each(dataArray,function () {
        //this是每一次遍历出来的那个对象
        data[this.name] = this.value;
    });
    console.log(data);
    $.post(SCOPE.save_url,data,function (res) {
        if (res.status == 1)
        {
            return dialog.success(res.msg,SCOPE.jump_url);
        }
        if (res.status == 0)
        {
            return dialog.error(res.msg);
        }
    },'JSON');

});

//删除按钮的点击事件
$('#wrapper #cms-delete').click(function () {
    var id = $(this).attr('attr-id');

    var data = {
        common_id:id ,
        status : -1
    };
    layer.open({
        title:'提示',
        icon : 3 ,
        btn  : ['yes','no'],
        content:'确认删除吗',
        yes:function () {
            toDelete(data);
        }
    });
});
function toDelete(data) {
    $.post(SCOPE.delete_url,data,function (res) {
        console.log(res);
        if (res.status == 0)
        {
            dialog.error(res.msg);
        }
        if (res.status == 1)
        {
            dialog.success(res.msg,SCOPE.jump_url);
        }
    },'JSON');
}
//编辑
$('.cms-table #cms-edit').click(function () {
    var common_id = $(this).attr('attr-id');
    //跳转到后端的menu的edit方法
    window.location.href = SCOPE.edit_url+'&common_id='+common_id;
});
//点击更新排序
$('#button-listorder').click(function () {
    var dataArray = $('#cms-listorder').serializeArray();
    var data = {};
    console.log(dataArray);
    $.each(dataArray,function () {
        data[this.name] = this.value;
    });
    console.log(data);
    $.post(SCOPE.listorder_url,data,function (res) {
        if (res.status == 0)
        {
            dialog.error(res.msg);
        }
        if (res.status == 1)
        {
            dialog.success(res.msg,SCOPE.jump_url);
        }
    },'JSON');
});
// $(".form-control").on('change',function () {
//     var id = this.value;
//     window.location.href = './admin.php?c=positioncontent&a=index&position_id='+id;
// });

$('#cms-push').click(function () {
    var obj = document.getElementsByName('pushcheck');
    var newsId = [];
    for ( var i = 0; i < obj.length;i++)
    {
        if(obj[i].checked)
        {
            newsId.push(obj[i].value);
        }
    }
    var positionId = $('#select-push').val();
    if (positionId == 0)
    {
        return dialog.error('推荐位不能为空');
    }
     var data = {
        'newsId' : newsId,
        'positionId' : positionId
    };
    $.post(SCOPE.push_url,data,function (res) {
        if (res.status  == 0);
        {
            dialog.error(res.msg);
        }
        if (res.status == 1)
        {
            dialog.success(res.msg,SCOPE.jump_url);
        }
    },'JSON');
});

// $('#cms-push').click(function () {
//     var id = $('#select-push').val();
//     if (id == 0)
//     {
//         return dialog.error('请选择职位');
//     }
//     var pushData = {};
//     $.each($('input[name="pushcheck"]:checked'),
//         function (i) {
//             pushData[i] = $(this).val();
//         }
//     );
//     var postData = {
//         'positionId' : id,
//         'pushData' : pushData
//     }
// });
// window.onload = function () {
//     $('#pageId1').toggleClass('active');
//
// };
// function searchByNum(num) {
//     var p = num;
//     var data = {
//         p : p,
//     };
//     var url = SCOPE.search_url;
//     $.post(url,data,function (res) {
//         $('#menu').html(res);
//         changeClass(p);
//     },'HTML');
// }
// function searchByNext() {
//     var id = $('.pagination .active').attr('data-id');
//     console.log(id);
//     var newId = Number(id)+1;
//     if (newId == 3)
//     {
//
//     }
//     console.log(newId);
//     var data = {
//         p : newId,
//     }
//     var url = SCOPE.search_url;
//     $.post(url,data,function (res) {
//         $('#menu').html(res);
//         changeClass(newId);
//     },'HTML');
// }
// function searchByPrev() {
//     var id = $('.pagination .active').attr('data-id');
//     console.log(id);
//     var newId = Number(id)-1;
//     console.log(newId);
//     var data = {
//         p : newId,
//     }
//     var url = SCOPE.search_url;
//     $.post(url,data,function (res) {
//         $('#menu').html(res);
//         changeClass(newId);
//     },'HTML');
//
// }
// function changeClass(id) {
//     $('#pageId'+id).toggleClass('active');
// }


