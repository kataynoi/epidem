<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Epidem_model extends CI_Model {

    public function get_epidem($date_start,$date_end,$hospcode)
    {
        /*$date_start='20130101';
        $date_end='20130131';*/
        //$str='';
        $rs = $this->hdc
            ->select("SUBSTR(s.DATE_SERV,1,4) as YEAR,s.HOSPCODE,p.CID,p.HN,p.`NAME`,p.LNAME",FALSE)
            ->select("p.SEX,p.BIRTH,IF(p.MOTHER='',p.FATHER,p.MOTHER) as MOM_NAME,p.MSTATUS,p.OCCUPATION_NEW,p.NATION,s.DATE_SERV",FALSE)
            ->select("s.AN,s.DATETIME_ADMIT,s.SYNDROME,s.DIAGCODE,s.CODE506,s.DIAGCODELAST,s.CODE506LAST,s.ILLDATE",FALSE)
            ->select("s.ILLHOUSE,s.ILLVILLAGE,s.ILLTAMBON,s.ILLAMPUR,s.ILLCHANGWAT,s.LATITUDE,s.LONGITUDE,s.PTSTATUS,s.DATE_DEATH",FALSE)
            ->select("s.COMPLICATION,s.ORGANISM,CONCAT(pv.NAME,'  ',pv.LNAME) as PROVIDER,s.D_UPDATE",FALSE)
            ->where('s.DATE_SERV BETWEEN ',$date_start.' AND '.$date_end,false)
            ->where('s.HOSPCODE',$hospcode)
            ->join('person56 p','p.HOSPCODE=s.HOSPCODE and p.PID=s.PID','LEFT')
            ->join('provider pv','pv.HOSPCODE=s.HOSPCODE AND pv.PROVIDER=s.PROVIDER','LEFT')
            ->get('surveillance s')
            ->result();
        return $rs;
        // echo  $this->db->last_query();
        //echo 'HPP : '.$hospcode;
    }
}
