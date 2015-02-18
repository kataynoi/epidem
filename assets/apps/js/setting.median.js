$(document).ready(function(){
    $('#btn_save').hide();
    var setting = {};
    setting.ajax = {
        get_median_month: function (items, cb) {
            var url = '/settings/get_median_month',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },save_median_month: function (items, cb) {
            var url = '/settings/save_median_month',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    };


    // Save Edit User
    setting.save_edit_hserv = function(items){
        //app.alert('Save Pass : '+user_id+' : '+password);
        setting.ajax.save_edit_hserv(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขข้อมูล เรียบร้อยแล้ว');
            }
        });
    }

    setting.get_median_month = function (items) {

        $('#tbl_median> tbody').empty();

        setting.ajax.get_median_month(items, function (err, data) {
            if (!err) {
                _.each(data.rows, function (v) {
                     $('#tbl_median> tbody').append('' +
                         '<tr data-id="'+v.code506+'">' +
                         '<td>'+ v.hospname+'</td>' +
                         '<td>'+ v.year +'</td>' +
                         '<td>'+ v.diseasename +'</td>' +
                         '<td>'+ v.m1 +'</td>' +
                         '<td>'+ v.m2 +'</td>' +
                         '<td>'+ v.m3 +'</td>' +
                         '<td>'+ v.m4 +'</td>' +
                         '<td>'+ v.m5 +'</td>' +
                         '<td>'+ v.m6 +'</td>' +
                         '<td>'+ v.m7 +'</td>' +
                         '<td>'+ v.m8 +'</td>' +
                         '<td>'+ v.m9 +'</td>' +
                         '<td>'+ v.m10 +'</td>' +
                         '<td>'+ v.m11 +'</td>' +
                         '<td>'+ v.m12 +'</td>' +
                         '</tr>' +
                         '');
                });
                $('#btn_save').hide();
            }
        });

    };

    setting.get_median_month_hosp = function (items) {

        $('#tbl_median> tbody').empty();

        setting.ajax.get_median_month(items, function (err, data) {
            if (!err) {
                _.each(data.rows, function (v) {
                     $('#tbl_median> tbody').append('' +
                         '<tr data-id="'+v.code506+'">' +
                         '<td>'+ v.hospname+'</td>' +
                         '<td>'+ v.year +'</td>' +
                         '<td>'+ v.diseasename +'</td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m1" value="'+ v.m1 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m2" value="'+ v.m2 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m3" value="'+ v.m3 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m4" value="'+ v.m4 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m5" value="'+ v.m5 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m6" value="'+ v.m6 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m7" value="'+ v.m7 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m8" value="'+ v.m8 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m9" value="'+ v.m9 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m10" value="'+ v.m10 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m11" value="'+ v.m11 +'"></td>' +
                         '<td><input class="form-control"  style="width:50px;padding: 1px;" id="m12" value="'+ v.m12 +'"></td>' +

                         '</tr>' +
                         '');
                });
            }
            $('#btn_save').show();
        });

    };


    $('#btn_show').on('click',function(){
        var items={};
        items.hospcode=$('#hospcode').val();
        items.year = $('#sl_year').val();
        items.code506 = $('#sl_code506').val();

        if (!items.year) {
            app.alert('กรุณาเลือกปี ก่อน ');
            $('#sl_village').focus();
        }else{
            if(!items.code506){
                setting.get_median_month(items);
            }else{
                setting.get_median_month_hosp(items);
            }

        }
    });

    $('#btn_save').on('click',function(){
        var items={};
        items.hospcode=$('#hospcode').val();
        items.year = $('#sl_year').val();
        items.code506 = $('#sl_code506').val();
        items.m1=$('#m1').val();
        items.m2=$('#m2').val();
        items.m3=$('#m3').val();
        items.m4=$('#m4').val();
        items.m5=$('#m5').val();
        items.m6=$('#m6').val();
        items.m7=$('#m7').val();
        items.m8=$('#m8').val();
        items.m9=$('#m9').val();
        items.m10=$('#m10').val();
        items.m11=$('#m11').val();
        items.m12=$('#m12').val();

        if (!items.m1 ||!items.m2||!items.m3||!items.m4||!items.m5||!items.m6||!items.m7||!items.m8||!items.m9||!items.m10||!items.m11||!items.m12) {
            app.alert('กรุณาบันทึกข้อมูลให้ครบถ้วน หากไม่มีผู้ป่วยกรุณาใส่ 0');
        }else{

            setting.ajax.save_median_month(items, function (err, data) {
                if (err) {
                    app.alert(err);
                }
                else {
                    alert('แก้ไขข้อมูล เรียบร้อยแล้ว');
                }
            });
        }
    });

    $(document).on('click', 'a[data-name="del_village_base"]', function(e) {
        e.preventDefault();
        var villid = $(this).data('id');
        if(confirm('ต้องการลบหมู่บ้านรับผิดชอบ')){
            //app.alert(villid);
            setting.del_village_base(villid);
        }

    });
});