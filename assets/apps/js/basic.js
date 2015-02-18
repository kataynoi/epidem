$(document).ready(function(){
    //User namespace
    var basic = {};
    basic.ajax = {
        get_office_list: function (amp, cb) {
            var url = '/basic/get_office_list_by_amp',
                params = {
                    amp: amp
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }

    };

    basic.modal = {
        show_message: function () {
            $('#mdl_message').modal({
                keyboard: false,
                backdrop: 'static'
            })
        },
        hide_message: function() {
            $('#mdl_message').modal('hide');
        }
    };
    basic.get_office_list=function(amp){
        $('#sl_office').empty();
        basic.ajax.get_office_list(amp, function (err, data) {
            if (err) {
                $('#sl_office').append('<option> ไม่มีหน่วยบริการ </option>')
            } else {
                $('#sl_office').append('<option value=""> เลือกหน่วยบริการ </option>')
                _.each(data.rows, function (v) {
                    $('#sl_office').append('<option value="' + v.off_id + '">[' + v.off_id + '] ' + v.off_name + '</option>');
                });
            }
        });
    }

    $('#distid').on('change', function () {

        var amp = $(this).val();
        basic.get_office_list(amp);
    });
});