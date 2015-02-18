<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Report model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Reports_model extends CI_Model
{
    public $hospcode;
    public $hserv;
    public function get_list_total_by_code506($filed,$val, $s, $e, $c){
        $rs = $this->db
            ->where($filed, $val,false)
            ->where('disease',$c)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_total_by_code506_nation($filed,$val, $s, $e, $c,$n){
        $rs = $this->db
            ->where($filed, $val,false)
            ->where('disease',$c)
            ->where('nation',$n)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }
    public function get_list_total_by_nation($filed,$val, $s, $e,$n){
        $rs = $this->db
            ->where($filed, $val,false)
            ->where('nation',$n)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }
 public function get_list_total_by_date($filed,$val, $s, $e){
        $rs = $this->db
            ->where($filed, $val,false)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_by_code506($filed,$val, $s, $e, $c ,$start,$limit,$order_by)
    {
        $result = $this->db
            ->where($filed, $val,false)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->where('disease', $c)
            ->order_by($order_by)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }
    public function get_list_by_code506_nation($filed,$val,$s, $e,$c,$n,$start,$limit,$order_by)
    {
        $result = $this->db
            ->where($filed, $val,false)
            ->where('nation',$n)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->where('disease', $c)
            ->order_by($order_by)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }
    public function get_list_by_nation($filed,$val,$s, $e,$n,$start,$limit,$order_by)
    {
        $result = $this->db
            ->where($filed, $val,false)
            ->where('nation',$n)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->order_by($order_by)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }
    public function get_list_by_date($filed,$val,$s, $e,$start,$limit,$order_by)
    {
        $result = $this->db
            ->where($filed, $val,false)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->order_by($order_by)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }
    public function get_pt_foreign($year){
        $rs=$this->db
            ->select('a.hospcode,a.nation,b.name as nation_name,COUNT(*) as total')
            ->where('year',$year)
            ->where('a.nation !="099"')
            ->group_by('nation')
            ->order_by('total','DESC')
            ->join('ref_nhso_nation b','a.nation=b.code')
            ->get('epe0 a')
            ->result();
        return $rs;
    }
    public function get_top10_506($year){
        $rs=$this->db
            ->select('a.diag_principle,b.name,COUNT(*) as total')
            ->where('year',$year)
            ->group_by('diag_principle')
            ->order_by('total','DESC')
            ->join('ref_code506 b','a.disease=b.code')
            ->limit('10')
            ->get('epe0 a')
            ->result();
        return $rs;
    }
    public function get_r506_by_amp($year){
        $rs=$this->db
            ->select('a.amp_code,b.distname,COUNT(*) as total')
            ->where('year',$year)
            ->group_by('amp_code')
            ->order_by('total','DESC')
            ->join('co_district b','a.amp_code=b.distid')
            ->get('epe0 a')
            ->result();
        return $rs;
    }
    public function get_disease_by_year_code506($year,$code506){
        $sql="SELECT a.m_id,a.fullname,b.total FROM co_month a ";
        $sql.=" LEFT JOIN ";
        $sql.=" (SELECT DATE_FORMAT(a.datefine,'%m') as M,count(*) as total  FROM epe0 a WHERE a.disease='".$code506."' AND a.`year`='".$year."' GROUP BY M) b ON a.m_id=b.M";
        $rs=$this->db->query($sql)->result();

        return $rs;

    } public function get_disease_by_year($year){
        $sql="SELECT a.m_id,a.fullname,b.total FROM co_month a ";
        $sql.=" LEFT JOIN ";
        $sql.=" (SELECT DATE_FORMAT(a.datefine,'%m') as M,count(*) as total  FROM epe0 a WHERE a.`year`='".$year."' GROUP BY M) b ON a.m_id=b.M";
        $rs=$this->db->query($sql)->result();

        return $rs;

    }
    public function get_median_month($year,$code506,$m){
        $m="m".(int)$m;
        $rs=$this->db
            ->select($m)
            ->where('year',$year)
            ->where('code506',$code506)
            ->where('hospcode','00031')
            ->get('median_month')
            ->row();
        return count($rs) > 0 ? $rs->$m : 0;
    }
}
/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */