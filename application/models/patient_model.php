<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
*/
class Patient_model extends CI_Model {

    public $hospcode;
    public $hserv;

    public function get_list($start, $limit)
    {
        $result = $this->db
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_total(){
        $rs = $this->db
            ->count_all_results('epe0');
        return $rs;
    }

    public function check_duplicate_tmp($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            //->or_where('RECORD_STATUS', '1')
            ->count_all_results('surveillance');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function check_tmp_approve_status($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            ->where_in('record_status', array('1', '2'))
            ->count_all_results('surveillance');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function get_tmp_date_update($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            ->limit(1)
            ->get('surveillance')
            ->row();

        return $rs ? $rs->d_update : NULL;
    }


    public function get_import($s, $e, $start, $limit)
    {
        $rs = $this->db
            ->select(array('s.*', 'i.desc_r as diagname'))
            ->where(array(
                'date_serv >=' => $s,
                'date_serv <=' => $e,
                'hospcode' => $this->hospcode
            ))
            ->where_not_in('record_status', array('1', '2'))
            ->join('ref_icd10 i', 'i.code=s.diagcode', 'left')
            ->limit($limit, $start)
            ->get('surveillance s')
            ->result();

        return $rs;
    }

    public function get_import_total($s, $e)
    {
        $rs = $this->db
            ->where(array(
                'date_serv >=' => $s,
                'date_serv <=' => $e,
                'hospcode' => $this->hospcode
            ))
            ->where_not_in('record_status', array('1', '2'))
            ->count_all_results('surveillance');

        return $rs;
    }

    public function get_tmp_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('surveillance')
            ->result();

        return count($rs) > 0 ? $rs[0] : NULL;
    }

    public function insert_tmp($data)
    {
        $rs = $this->db
            ->set('an', $data->AN)
            ->set('birth', $data->BIRTH)
            ->set('cid', $data->CID)
            ->set('code506', $data->CODE506)
            ->set('code506last', $data->CODE506LAST)
            ->set('complication', $data->COMPLICATION)
            ->set('datetime_admit', $data->DATETIME_ADMIT)
            ->set('date_death', $data->DATE_DEATH)
            ->set('date_serv', $data->DATE_SERV)
            ->set('diagcode', $data->DIAGCODE)
            ->set('diagcodelast', $data->DIAGCODELAST)
            ->set('d_update', $data->D_UPDATE)
            ->set('hn', $data->HN)
            ->set('hospcode', $data->HOSPCODE)
            ->set('illampur', $data->ILLAMPUR)
            ->set('illchangwat', $data->ILLCHANGWAT)
            ->set('illdate', $data->ILLDATE)
            ->set('illhouse', $data->ILLHOUSE)
            ->set('illtambon', $data->ILLTAMBON)
            ->set('illvillage', $data->ILLVILLAGE)
            ->set('latitude', $data->LATITUDE)
            ->set('lname', $data->LNAME)
            ->set('longitude', $data->LONGITUDE)
            ->set('mom_name', $data->MOM_NAME)
            ->set('mstatus', $data->MSTATUS)
            ->set('name', $data->NAME)
            ->set('nation', $data->NATION)
            ->set('occupation_new', $data->OCCUPATION_NEW)
            ->set('organism', $data->ORGANISM)
            ->set('provider', $data->PROVIDER)
            ->set('ptstatus', $data->PTSTATUS)
            ->set('sex', $data->SEX)
            ->set('syndrome', $data->SYNDROME)
            ->set('year', $data->YEAR)
            ->set('record_status', '0')
            ->insert('surveillance');

        return $rs;
    }
    public function update_tmp($data)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $data->DIAGCODE,
                'cid' => $data->CID,
                'date_serv' => $data->DATE_SERV
            ))
            ->set('an', $data->AN)
            ->set('birth', $data->BIRTH)
            //->set('CID', $data->CID)
            ->set('code506', $data->CODE506)
            ->set('code506last', $data->CODE506LAST)
            ->set('complication', $data->COMPLICATION)
            ->set('datetime_admit', $data->DATETIME_ADMIT)
            ->set('date_death', $data->DATE_DEATH)
            //->set('DATE_SERV', $data->DATE_SERV)
            //->set('DIAGCODE', $data->DIAGCODE)
            ->set('diagcodelast', $data->DIAGCODELAST)
            ->set('d_update', $data->D_UPDATE)
            ->set('hn', $data->HN)
            //->set('HOSPCODE', $data->HOSPCODE)
            ->set('illampur', $data->ILLAMPUR)
            ->set('illchangwat', $data->ILLCHANGWAT)
            ->set('illdate', $data->ILLDATE)
            ->set('illhouse', $data->ILLHOUSE)
            ->set('illtambon', $data->ILLTAMBON)
            ->set('illvillage', $data->ILLVILLAGE)
            ->set('latitude', $data->LATITUDE)
            ->set('lname', $data->LNAME)
            ->set('longitude', $data->LONGITUDE)
            ->set('mom_name', $data->MOM_NAME)
            ->set('mstatus', $data->MSTATUS)
            ->set('name', $data->NAME)
            ->set('nation', $data->NATION)
            ->set('occupation_new', $data->OCCUPATION_NEW)
            ->set('organism', $data->ORGANISM)
            ->set('provider', $data->PROVIDER)
            ->set('ptstatus', $data->PTSTATUS)
            ->set('sex', $data->SEX)
            ->set('syndrome', $data->SYNDROME)
            ->set('year', $data->YEAR)
            ->update('surveillance');

        return $rs;
    }

    public function remove_tmp($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->delete('surveillance');

        return $rs;
    }
    public function update_tmp_record_status($id)
    {
        $rs = $this->db
            ->set('record_status', '1')
            ->where(array('id' => $id))
            ->update('surveillance');

        return $rs;
    }

    public function get_waiting_list($start, $limit)
    {
        $rs = $this->db
            ->select(array('s.*', 'i.desc_r as diagname'))
            ->where(array(
                's.record_status' => '1',
                's.hospcode' => $this->hospcode,
                's.record_status' => '1'))
            ->join('ref_icd10 i', 'i.code=s.diagcode', 'left')
            ->limit($limit, $start)
            ->order_by('date_serv')
            ->get('surveillance s')
            ->result();

        return $rs;
    }
    public function get_waiting_list_total()
    {
        $rs = $this->db
            ->where(array(
                'record_status' => '1', 
                'hospcode' => $this->hospcode,
                'record_status' => '1'
            ))
            ->count_all_results('surveillance');

        return $rs ? $rs : 0;
    }

    public function get_waiting_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('surveillance')
            ->result();

        return $rs;
    }

    public function updat_waiting_status($id, $status)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->set('record_status', '2')
            ->update('surveillance');

        return $rs;
    }

    public function check_e0_exist($date_serv, $diagcode)
    {
        $rs = $this->db
            ->where(array(
                'datesick' => $date_serv,
                'icd10' => $diagcode
            ))
            ->count_all_results('epe0');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function save($data)
    {
        $rs = $this->db
            //->set('year', $data['year'])
            ->set('hospcode', $this->hospcode)
            ->set('e0_hosp', $data['e0_hosp'])
            ->set('e1_hosp', $data['e1_hosp'])
            ->set('disease', $data['code506'])
            ->set('birth', to_mysql_date($data['birth']))
            ->set('name', $data['name'] . ' ' . $data['lname'])
            ->set('hn', $data['hn'])
            ->set('nation', $data['nation'])
            ->set('nmepate', $data['nmepate'])
            ->set('sex', $data['sex'])
            ->set('agey', $data['agey'])
            ->set('agem', $data['agem'])
            ->set('aged', $data['aged'])
            ->set('marietal', $data['mstatus'])
            //->set('race', $data[''])
            //->set('race1', $data['year'])
            ->set('occupat', $data['occupation'])
            ->set('address', $data['address'])
            ->set('soi', $data['soi'])
            ->set('road', $data['road'])
            ->set('addrcode', $data['addrcode'])
            ->set('metropol', $data['address_type'])
            ->set('hospital', $data['service_place'])
            ->set('type', $data['patient_type'])
            ->set('result', $data['ptstatus'])
            ->set('hserv', $data['hserv'])
            ->set('class', $data['school_class'])
            ->set('school', $data['school'])
            ->set('datesick', to_mysql_date($data['illdate']))
            ->set('datefine', to_mysql_date($data['date_serv']))
            ->set('datedeath', to_mysql_date($data['date_death']))
            ->set('daterecord', to_mysql_date($data['date_record']))
            ->set('datereach', to_mysql_date($data['date_report']))
            //->set('intime', $data['year'])
            ->set('organism', $data['ogranism'])
            ->set('complica', $data['complication'])
            //->set('idrecord', $data['year'])
            ->set('icd10', $data['diagcode'])
            //->set('office_id', $data['year'])
            //->set('confirm', $data['year'])
            ->set('last_update', date('Y-m-d H:i:s'))
            ->insert('epe0');

        return $rs;
    }
}

/* End of file patient_model.php */
/* Location: ./application/models/patient_model.php */