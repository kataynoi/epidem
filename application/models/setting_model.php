<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 12/11/2556
 * Time: 0:31 น.
 * To change this template use File | Settings | File Templates.
 */

class Setting_model extends CI_Model
{
    public $hospcode;
    public $hserv;
    public function save_edit_hserv($data)
    {
        $rs = $this->db
            ->set('off_name',$data['name'])
            ->set('off_name2',$data['title'])
            ->set('hserv', $data['hserv'])
            ->set('amphur', $data['amp_code'])
            ->where('off_id',$data['hospcode'])
            ->update('co_office');

        return $rs;
    }
    public function save_village_base($data)
    {
        $rs = $this->db
            ->set('hospcode',$data['hospcode'])
            ->where('villid',$data['villid'])
            ->update('co_village');

        return $rs;
    }
    public function save_village($data)
    {
        $rs = $this->db
            ->set('villid',$data['villid'])
            ->set('villname',$data['villname'])
            ->set('villno',$data['villno'])
            ->set('locatype',$data['locatype'])
            ->set('subdistid',$data['subdistid'])
            ->set('distid',$data['distid'])
            ->set('provid',$data['provid'])
            ->insert('co_village');

        return $rs;
    }
    public function del_village_base($villid)
    {
        $rs = $this->db
            ->set('hospcode','')
            ->where('villid',$villid)
            ->update('co_village');

        return $rs;
    }

public function count_median_month($year,$hospcode){
    $rs = $this->db
        ->where('hospcode', $hospcode)
        ->where('year',$year)
        ->count_all_results('median_month');
    return $rs;
}
    public function set_new_median_month($year,$hospcode)
    {
        $rs=$this->basic->get_code506_list();
        $data = array();
        foreach($rs as $r){
            $data[] = array(
            'year' =>$year,
            'hospcode' =>$hospcode,
            'code506' =>$r->code );

        }
        //$data=(array)$obj1;
        $this->db->insert_batch('median_month', $data);
        //$this->db->insert_batch('median_month',$data);
    }

    public  function get_median_month($year,$hospcode){

        $rs = $this->db
            ->where('hospcode', $hospcode)
            ->where('year',$year)
            ->get('median_month')
            ->result();
    return $rs;
    }

    public  function save_median_month($data){

        $rs = $this->db
            ->set('m1',$data['m1'])
            ->set('m2',$data['m2'])
            ->set('m3',$data['m3'])
            ->set('m4',$data['m4'])
            ->set('m5',$data['m5'])
            ->set('m6',$data['m6'])
            ->set('m7',$data['m7'])
            ->set('m8',$data['m8'])
            ->set('m9',$data['m9'])
            ->set('m10',$data['m10'])
            ->set('m11',$data['m11'])
            ->set('m12',$data['m12'])
            ->where('year',$data['year'])
            ->where('hospcode',$data['hospcode'])
            ->where('code506',$data['code506'])
            ->update('median_month');
    return $rs;
    }



    public  function get_median_month_by_code506($year,$hospcode,$code506){

        $rs = $this->db
            ->where('hospcode', $hospcode)
            ->where('year',$year)
            ->where('code506',$code506)
            ->get('median_month')
            ->result();;
    return $rs;
    }
}

/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */