
$(document).ready(function(){
  // alert('User_');
    //User namespace
    var user = {};


    user.ajax = {
        set_session: function(data,cb){
            var url = 'users/user_session/',
                params = {
                    csrf: csrf_token,
                    datajson:data
                };

            app.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        logout: function(){
            var url = 'users/logout/',
                params = {
                    csrf: csrf_token
                };

            app.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    }
    user.check_login = function(){

        var items = {};
        items.user = $('#txtUsername').val();
        items.pass = $('#txtPassword').val();

    if(!items.user || !items.pass){
        app.alert('กรุณาใส่ผู้ใช้งาน และรหัสผ่านให้ถูกต้อง','ข้อผิดพลาด');
    }else{

        var url = 'http://localhost/usercenter2/index.php/webservice/do_auth?callback=?';
        //var url = 'http://203.157.185.7/usercenter/index.php/webservice/do_auth?callback=?';
        $.ajax({
            url:url,
            dataType:'json',
            type:'POST',
            data: {username:items.user,password:items.pass,sys_id:'5'},
            success:function (data) {
                if (data.success) {

/*                    user.ajax.set_session(data,function(err){
                        if(err)
                        {
                            app.alert('ไม่สามารถเข้าสู่ระบบไ้ด');
                        }
                        else
                        {
                            app.alert('ยินดีต้อนรับเข้าสู่ระบบ');                      }
                    });*/


                    $.post(base_url+"index.php/users/user_session/",{csrf_token_name:csrf_token,datajson:data},
                        function(data){
                            location.reload();
                        });

                }else{
                    alert('ข้อมูลไม่ถูกต้องกรุณษเข้าสู่ระบบอีกครั้ง');
                }
            },
            error:function (xhr, status, errorThrown) {
                console.log('เกิดข้อผิดพลาด: ' + xhr.status + ': ' + xhr.statusText);
            }
        });
    }

    }
    user.log_out = function(){
        user.ajax.logout(data,function(err){
            if(err)
            {
                app.alert('ไม่สามารถเข้าสู่ระบบไ้ด');
            }
            else
            {
                app.alert('ยินดีต้อนรับเข้าสู่ระบบ');                      }
        });
    }
    $('#txtPassword').bind('keypress', function(e) {
        if(e.keyCode==13){
            user.check_login();
        }
    });

    //Do login
    $('#btnDoLogin').on('click',function(){
        //alert('sdfgdgdfg');
        user.check_login();
    });

    $('#btnDoLogout').on('click',function(){
        //alert('sdfgdgdfg');
        if(confirm('คุณต้องการออกจากระบบ')){
            window.location.replace(site_url+"users/logout");
        };

    });
});