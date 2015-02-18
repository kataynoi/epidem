<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Changwat_model extends CI_Model
{
    public $hospcode;
    public $hserv;
    public $year;
    public $provid;
    public function get_list($start, $limit)
    {
        $result = $this->db
            ->where('e0 IS NOT NULL')
            ->where('year',$this->year)
            ->where('provid',$this->provid)
            ->order_by('e0')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_total(){
        $rs = $this->db
            ->where('e.e0 IS NOT NULL')
            ->where('provid',$this->provid)
            ->where('year',$this->year)
            ->count_all_results('epe0 e');
        return $rs;
    }

    public function get_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('epe0')
            ->result();

        return count($rs) > 0 ? $rs[0] : NULL;
    }

    public function get_waiting_list($start, $limit)
    {
        $rs = $this->db
            ->select(array('e.*', 'i.desc_r as diag_name', 'c.name as code506_name'))
            ->where('e.e0 IS NULL')
            ->where('e.e0_sso IS NOT NULL')
            ->where('provid',$this->provid)
            ->where('year',$this->year)
            ->join('ref_icd10 i', 'i.code=e.icd10', 'left')
            ->join('ref_code506 c', 'c.code=e.disease', 'left')
            ->limit($limit, $start)
            ->order_by('e.datesick')
            ->get('epe0 e')
            ->result();

        return $rs;
    }

    public function get_waiting_list_total()
    {
        $rs = $this->db
            ->where('e.e0 IS NULL')
            ->where('e.e0_sso IS NOT NULL')
            ->where('provid',$this->provid)
            ->where('year',$this->year)
            ->count_all_results('epe0 e');

        return $rs ? $rs : 0;
    }

    public function do_approve($id, $e0, $e1)
    {
        $rs = $this->db
            ->where('id', $id)
            ->set('e0', $e0)
            ->set('e1', $e1)
            ->set('date_prov', date('Y-m-d H:i:s'))
            ->update('epe0');

        return $rs;
    }
public function do_delete_e0($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('epe0');

        return $rs;
    }

    public function get_e0(){
        $rs = $this->db
            ->select_max('e0','e0_max')
            ->where('provid',$this->provid)
            ->where('year',$this->year)
            ->get('epe0')
            ->row();
        return $rs->e0_max;
    }

    public function get_e1( $code506){
        $rs = $this->db
            ->select_max('e1',' e1_max')
            ->where('provid',$this->provid)
            ->where('disease',$code506)
            ->where('year',$this->year)
            ->get('epe0')
            ->row();
        return $rs->e1_max;
    }

}