<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก</a> </li>
    <li class="active">นำเข้าข้อมูล</li>
</ul>

<div class="navbar">
    <form action="#" class="navbar-form">
        <label>ตั้งแต่วันที่</label>
        <input type="text" id="txt_start_date" data-type="date" 
        placeholder="dd/mm/yyyy" title="ระบุวันที่" rel="tooltip" style="width: 150px;">

        <label>ถึงวันที่</label>
        <input type="text" id="txt_end_date" data-type="date" 
        placeholder="dd/mm/yyyy" title="ระบุวันที่" rel="tooltip" style="width: 150px;">
        <button type="button" class="btn btn-primary" id="btn_get_list">
            <i class="glyphicon glyphicon-search"></i>
        </button>
|
        <div class="btn-group">
            <button type="button" class="btn btn-success" id="btn_check_all" title="เลือกทั้งหมด" data-rel="tooltip">
                <i class="glyphicon glyphicon-ok"></i> เลือก
            </button>
            <button type="button" class="btn btn-default" id="btn_clear_all" title="ยกเลิกทั้งหมด" data-rel="tooltip">
                <i class="glyphicon glyphicon-remove"></i> ยกเลิก
            </button>
        </div>

        <button type="button" class="btn btn-success pull-right" id="btn_do_import" title="นำเข้ารายการ" data-rel="tooltip">
            <i class="glyphicon glyphicon-share"></i> นำเข้า
        </button>
    </form>
</div>

<table class="table table-striped" id="tbl_list">
    <thead>
        <tr>
            <th>นำเข้า</th>
            <th>วันที่</th>
            <th>เลขบัตรประชาชน</th>
            <th>ชื่อ - สกุล</th>
            <th>วันเกิด</th>
            <th>อายุ (ปี)</th>
            <th>สถานะ</th>
            <th>รหัสการวินิจฉัยโรค</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="8">...</td>
        </tr>
    </tbody>
</table>

<ul class="pagination" id="main_paging"></ul>

<div class="modal fade" id="mdl_info">
    <div class="modal-dialog" style="width: 960px; left: 35%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ข้อมูลระบาดวิทยา</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-inline well well-small">
                    <label for="txt_tdetail_fullname">ชื่อ-สกุล</label>
                    <input id="txt_tdetail_fullname" type="text" style="width: 250px;" disabled />
                    <label for="txt_tdetail_cid">CID</label>
                    <input id="txt_tdetail_cid" type="text" style="width: 250px;" disabled />
                    <label for="txt_tdetail_birth">วันเกิด</label>
                    <input id="txt_tdetail_birth" type="text" style="width: 100px;" disabled />
                    <label for="txt_tdetail_age">อายุ</label>
                    <input id="txt_tdetail_age" type="text" style="width: 60px;" disabled />
                    ปี
                </form>

                <legend><i class="icon-user-md"></i> ข้อมูลรับบริการ</legend>

                <form action="#" class="form-horizontal">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="txt_tdetail_date_serv">วันที่รับบริการ</label>
                            <input id="txt_tdetail_date_serv" type="text" disabled />
                        </div>
                        <div class="col-lg-2">
                            <label for="">วันที่ป่วย</label>
                            <input id="txt_tdetail_illdate" type="text" disabled />
                        </div>
                        <div class="col-lg-2">
                            <label for="">สภาพผู้ป่วย</label>
                            <input id="txt_tdetail_ptstatus" type="text" disabled/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="txt_tdetail_code506">รหัส</label>
                            <input id="txt_tdetail_code506" type="text" disabled />
                        </div>
                        <div class="col-lg-10">
                            <label for="txt_tdetail_code506_name">ชื่อกลุ่มโรค 506</label>
                            <input id="txt_tdetail_code506_name" type="text" disabled/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="txt_tdetail_diagcode">รหัส</label>
                            <input id="txt_tdetail_diagcode" type="text" disabled />
                        </div>
                        <div class="col-lg-10">
                            <label for="txt_tdetail_diagname">การวินิจฉัยโรค</label>
                            <input id="txt_tdetail_diagname" type="text" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="txt_tdetail_date_death">วันที่เสียชีวิต</label>
                            <input id="txt_tdetail_date_death" type="text" disabled />
                        </div>
                        <div class="col-lg-10">
                            <label for="">ที่อยู่ขณะป่วย</label>
                            <input id="txt_tdetail_address" type="text" disabled />
                        </div>
                    </div>
                </form>

            </div><!--
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> ปิดหน้าต่าง</button>
            </div>-->
        </div>
    </div>
</div>


<script src="<?=base_url()?>assets/apps/js/patient.import.js" charset="utf-8"></script>