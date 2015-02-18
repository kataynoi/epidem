$(function () {
    function ajaxFileUpload(cs)
    {
        $("#loading")
            .ajaxStart(function(){
                $(this).show();
            })
            .ajaxComplete(function(){
                $(this).hide();
            });

        $.ajaxFileUpload
        (
            {
                url:site_url+'/upload/do_upload_r506',
                secureuri:false,
                fileElementId:'userfile',
                dataType: 'json',
                data:{name:'logan', id:'id',csrf_token:cs},
                success: function (data, status)
                {
                    alert(data);
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )

        return false;

    }




    var patient = {};

    patient.ajax = {
        upload_r506: function (items,userfile, cb) {
            var url = '/upload/do_upload_r506',
                params = {
                    fileElementId:userfile,
                    items: items

                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    };


    patient.upload_r506 = function (items,userfile) {

            patient.ajax.upload_r506(items,userfile,function (err, data) {
                if (err) {
                    app.alert(err);
                }
                else {
                    //patient.get_import();
                    app.alert(data);
                }
            });
    };



    $(document).on('click', 'button[data-name="btn_upload"]', function (e) {
        e.preventDefault();
        var items = {};
        items.hospcode = '04911';
        items.csrf_token=$('#csrf_name').val();
        ajaxFileUpload(items.csrf_token);
        //patient.upload_r506(items,userfile)
    });


}); 


