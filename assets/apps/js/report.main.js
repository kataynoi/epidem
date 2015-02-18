$(function () {

    var patient = {};
    patient.modal = {
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

    patient.ajax = {
        get_e1_list: function (code506,start, stop, cb) {
            var url = '/reports/get_e1_list',
                params = {
                    code506: code506,
                    start: start,
                    stop: stop
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_e1_list_total: function (code506,cb) {
            var url = '/reports/get_e1_list_total',
                params = {
                    code506:code506
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    }

    patient.set_e1_list = function (data) {
        $('#tbl_e1_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                $('#tbl_e1_list > tbody').append(
                    '<tr>' +
                        '<td></td>' +
                        '<td>' + v.e1 + '</td>' +
                        '<td>' + app.strip(v.code506, 45) + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + app.clear_null(v.address) + '</td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td>'+ v.datefine+'</td>' +
                        '<td>' + v.datesick + '</td>' +

                        '<td><a href="javascript:void(0);" class="btn btn-small btn-success" data-id="' + v.id + '" ' +
                        'data-name="btn_patient_detail"><i class="glyphicon glyphicon-edit"></i></a></td>' +
                        '</tr>'
                );
            });
        }
        else {
            $('#tbl_e1_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }
    };

    patient.get_e1_list = function () {

        $('#tbl_e1_list > tbody').empty();
        var code506 = $('#sl_code506').val();
        patient.ajax.get_e1_list_total(code506,function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_e1_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('patient_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_index_paging', page);
                        patient.ajax.get_e1_list(code506,this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_e1_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                            } else {
                                patient.set_e1_list(data);
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


    $(document).on('click', 'a[data-name="btn_search_e1"]', function () {
        patient.get_e1_list();
    });



// #### set_waiting list สสจ. สสอ.

    //======= Remove record =======//
    $(document).on('click', 'a[data-name="btn_remove_tmp"]', function () {

        var id = $(this).data('id'),
            status = $(this).data('status'),

            obj = $(this).parent().parent().parent();

        if (status == '2') {
            app.alert('รายการนี้ถูกนำเข้าเรียบร้อยแล้ว ไม่สามารถลบรายการได้');
        }
        else {
            //do remove
            if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
                patient.ajax.remove_tmp(id, function (err) {
                    if (err) {
                        app.alert(err);
                    }
                    else {
                        app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                        obj.fadeOut('slow');
                    }
                });
            }
        }

    });

    //========== show edit approve =============//

    patient.get_tmp_detail = function (id) {

        patient.ajax.get_tmp_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                //clear form
                patient.clear_form();
                //set detail
                patient.set_edit_detail(data.rows);
                //show modal

                patient.modal.show_edit_approve();

            }
        });

    };
    patient.get_e0_detail = function (id) {

        patient.ajax.get_e0_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                //clear form
                //set detail
                patient.set_e0_detail(data.rows);
                //show modal

                patient.modal.show_e0_approve();
            }
        });

    };
    //set patient detail

    patient.set_edit_detail = function (v) {

        $('#txt_edit_id').val(v.id);
        $('#txt_name').val(v.name);
        $('#txt_lname').val(v.lname);
        $('#txt_cid').val(v.cid);
        $('#txt_birth').val(v.birth);
        $('#txt_age').val(v.age.year + '-' + v.age.month + '-' + v.age.day);
        $('#sl_sex').val(v.sex);
        $('#txt_hn').val(v.hn);
        //$('#txt_nmepate').val('');
        $('#sl_mstatus').val(v.mstatus);
        $('#sl_nations').val(v.nation);
        $('#sl_occupation').val(v.occupation);
        $('#txt_address').val(v.illhouse);
        //$('#txt_soi').val();
        //$('#txt_road').val();
        $('#sl_changwat').val(v.illchangwat);
        patient.get_ampur_list(v.illchangwat, v.illampur);
        patient.get_tambon_list(v.illchangwat, v.illampur, v.illtambon);
        //$('#sl_tambon').val();
        $('#sl_moo').val(v.illmoo);
        //$('#sl_address_type').val();
        //$('#txt_school').val();
        //$('#txt_school_class').val();
        $('#txt_illdate').val(v.illdate);
        $('#txt_date_serv').val(v.date_serv);
        //$('#sl_patient_type').val();
        //$('#sl_service_place').val();
        $('#txt_icd10_code').val(v.diagcode);
        $('#txt_icd10_name').val(v.diagname);
        $('#sl_code506').val(v.code506);
        $('#txt_e0_code506').val(v.code506);
        patient.get_organism(v.code506, v.organism);
        $('#sl_complication').val(v.complication);
        $('#sl_ptstatus').val(v.ptstatus);
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#txt_date_death').val(v.date_death);
        $('#txt_date_record').val(v.date_record);
        $('#txt_date_report').val(v.date_report);
    };
    patient.set_e0_detail = function (v) {

        $('#txt_e0_id').val(v.id);
        $('#txt_e0_code506').val(v.disease);

        $('#e0_name').text(v.name);
        $('#e0_cid').text(v.cid);
        $('#e0_birth').text(v.birth);
        $('#e0_age').text(v.age.year + '-' + v.age.month + '-' + v.age.day);
        $('#e0_sex').text(v.sex);
        $('#e0_hn').text(v.hn);
        //$('#txt_nmepate').val('');
        $('#e0_mstatus').text(v.mstatus);
        $('#e0_nations').text(v.nation);
        $('#e0_occupation').text(v.occupation);
        $('#e0_address').text(v.illhouse);
        //$('#txt_soi').text();
        //$('#txt_road').text();
        $('#e0_changwat').text(v.illchangwat);
        patient.get_ampur_list(v.illchangwat, v.illampur);
        patient.get_tambon_list(v.illchangwat, v.illampur, v.illtambon);
        //$('#sl_tambon').text();
        $('#e0_moo').text(v.illmoo);
        //$('#sl_address_type').text();
        //$('#txt_school').text();
        //$('#txt_school_class').text();
        $('#e0_illdate').text(v.illdate);
        $('#e0_date_serv').text(v.date_serv);
        //$('#sl_patient_type').text();
        //$('#sl_service_place').text();
        $('#e0_icd10_code').text(v.diagcode);
        $('#e0_icd10_name').text(v.diagname);
        $('#e0_code506').text(v.code506);
        $('#e0_e0_code506').text(v.code506);
        patient.get_organism(v.code506, v.organism);
        $('#e0_complication').text(v.complication);
        $('#e0_ptstatus').text(v.ptstatus);
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#e0_date_death').text(v.date_death);
        $('#e0_date_record').text(v.date_record);
        $('#e0_date_report').text(v.date_report);
    };

    //Save data
    $('#sl_code506').on('change', function () {

        var code506 = $(this).val();
        patient.get_organism(code506);
    });

    patient.get_organism = function (code506, org) {

        patient.ajax.get_organism_list(code506, function (err, data) {
            $('#sl_organism').empty();
            if (!err) {
                _.each(data.rows, function (v) {
                    if (org == v.code)
                        $('#sl_organism').append('<option value="' + v.code + '" selected="selected">' + v.name + '</option>');
                    $('#sl_organism').append('<option value="' + v.code + '">' + v.name + '</option>');
                });
            }
        });

    };

    //get ampur list
    $('#sl_changwat').on('change', function () {

        var chw = $(this).val();
        patient.get_ampur_list(chw);

    });

    //get tambon list
    $('#sl_ampur').on('change', function () {

        var chw = $('#sl_changwat').val();
        var amp = $(this).val();

        patient.get_tambon_list(chw, amp);

    });

    //get moo list
    $('#sl_tambon').on('change', function () {

        //var chw = $('#sl_changwat').val();
        //var amp = $('#sl_ampur').val();
        //var tmb = $(this).val();

        // patient.get_moo_list(chw, amp, tmb);

    });

    patient.get_ampur_list = function (chw, amp) {

        $('#sl_ampur').empty();

        patient.ajax.get_ampur_list(chw, function (err, data) {
            if (!err) {
                $('#sl_ampur').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == amp)
                        $('#sl_ampur').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_ampur').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    patient.get_tambon_list = function (chw, amp, tmb) {

        $('#sl_tambon').empty();

        patient.ajax.get_tambon_list(chw, amp, function (err, data) {
            if (!err) {
                $('#sl_tambon').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == tmb)
                        $('#sl_tambon').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_tambon').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    patient.get_moo_list = function (chw, amp, tmb, moo) {

        $('#sl_moo').empty();

        patient.ajax.get_moo_list(chw, amp, tmb, function (err, data) {
            if (!err) {
                $('#sl_moo').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == moo)
                        $('#sl_moo').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_moo').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    $('#sl_ptstatus').on('change', function () {
        var is_date = $(this).val() == '2' ? true : false;
        //alert(is_date);
        if (is_date) {
            $('#div_date_death').fadeIn('slow');
        } else {
            $('#div_date_death').fadeOut('slow');
            $('#txt_date_death').val('');
        }
    });

});
