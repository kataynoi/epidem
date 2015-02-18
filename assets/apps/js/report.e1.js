$(function () {

    var reports = {};
    reports.modal = {
        show_e0_approve: function () {
            $('#mdl_e0_for_approve').modal({
                keyboard: false,
                backdrop: 'static'
            });
        },
        hide_e0_approve: function () {
            $('#mdl_e0_for_approve').modal('hide');

        }
    };

    reports.ajax = {
        get_e1_list: function (start_date, end_date,  nation,code506,start, stop, cb) {
            var url = '/reports/get_e1_list',
                params = {
                    c:code506,
                    n: nation,
                    s: start_date,
                    e: end_date,
                    start: start,
                    stop: stop
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_e1_list_total: function (start_date, end_date, nation,code506,cb) {
            var url = '/reports/get_e1_list_total',
                params = {
                    c:code506,
                    n: nation,
                    s: start_date,
                    e: end_date
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    }

    reports.set_e1_list = function (data) {
        $('#tbl_e1_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'เสียชีวิต' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus == '9' ? 'ไม่ทราบ' : '-';
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
                var latlng = v.latlng == '1' ?
                    '<a href="javascript:void(0);" class="btn btn-success" data-name="btn_get_map" title="ดูแผนที่" data-rel="tooltip" ' +
                        'data-id="' + v.id + '"><i class="glyphicon glyphicon-globe"></i> </a>' :
                    '';
                $('#tbl_e1_list > tbody').append(
                    '<tr class="'+tr_death+'">' +
                        '<td>' + latlng + '</td>' +
                        '<td>' + v.e0 + '</td>' +
                        '<td>' + v.e1 + '</td>' +
                        '<td>' + app.strip(v.code506, 45) + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' +app.strip(v.address,45) + '</td>' +
                        '<td>'+ptstatus+'</td>' +
                        '<td>'+ app.strip(v.diag,20) +'</td>' +
                        '<td>'+ v.datefine+'</td>' +
                        '<td>' + v.datesick + '</td>' +

                        '<td><div class="btn-group">' +
                        '<button type="button" class="btn btn-success btn-small dropdown-toggle" data-toggle="dropdown">' +
                        '<i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu pull-right" role="menu">' +
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="' + v.id + '" data-name="btn_get_e0_detail">' +
                        '<i class="glyphicon glyphicon-edit"></i> ดูข้อมูล' +
                        '</a>' +
                        '</li>' +
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="'+ v.id +'" data-name="btn_set_map"> ' +
                        '<i class="glyphicon glyphicon-map-marker"></i> ระบุพิกัดแผนที่' +
                        '</a>' +
                        '</li>' +
                        '</ul>' +
                        '</div></td>' +
                        '</tr>'
                );
            });
        }
        else {
            $('#tbl_e1_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }
    };

    reports.get_e1_list = function (start_date, end_date, nation,code506) {

        $('#tbl_e1_list > tbody').empty();
        reports.ajax.get_e1_list_total(start_date, end_date, nation,code506,function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_e1_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
            } else {
                //$('#spn_total').html(app.add_commars_with_out_decimal(data.total));

                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('patient_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_index_paging', page);
                        reports.ajax.get_e1_list(start_date, end_date, nation,code506,this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_e1_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
                            } else {
                                reports.set_e1_list(data);
                            }
                        });

                    },
                    onFormat: function (type) {
                        switch (type) {

                            case 'block':

                                if (!this.active)
                                    return '<li class="disabled"><a href="">' + this.value + '</a></li>';
                                else if (this.value != this.page)
                                    return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
                                return '<li class="active"><a href="#">' + this.value + '</a></li>';

                            case 'right':
                            case 'left':

                                if (!this.active) {
                                    return "";
                                }
                                return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';

                            case 'next':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&raquo;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&raquo;</a></li>';

                            case 'prev':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&laquo;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&laquo;</a></li>';

                            case 'first':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&lt;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&lt;</a></li>';

                            case 'last':

                                if (this.active) {
                                    return '<li><a href="#' + this.value + '">&gt;</a></li>';
                                }
                                return '<li class="disabled"><a href="">&gt;</a></li>';

                            case 'fill':
                                if (this.active) {
                                    return '<li class="disabled"><a href="#">...</a></li>';
                                }
                        }
                        return ""; // return nothing for missing branches
                    }
                });
            }
        });
    };


    $(document).on('click', '#btn_get_e1_list', function () {
        var start_date = $('#txt_query_start_date').val(),
            end_date = $('#txt_query_end_date').val(),
            nation = $('#sl_query_nation').val(),
            code506 = $('#sl_query_code506').val();
        if (!start_date) {
            app.alert('กรุณาระบุ วันที่เริ่มต้น');
        } else if (!end_date) {
            app.alert('กรุณาระบุ วันที่สิ้นสุด');
        } else{
            reports.get_e1_list(start_date, end_date, nation,code506);
        }
    });
    $(document).on('click', 'a[data-name="btn_set_map"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        app.go_to_url('/maps/set_map/' + id);
    });
    $(document).on('click', 'a[data-name="btn_get_e0_detail"]', function () {

        var id = $(this).data('id');
        //get detail
        reports.get_e0_detail(id);

    });
    $(document).on('click', 'a[data-name="btn_get_map"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        app.go_to_url('/maps/show_map/' + id);
    });

    //reports.get_e1_list();

// #### set_waiting list สสจ. สสอ.

});

