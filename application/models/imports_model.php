<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exports model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Imports_model extends CI_Model {

    public $hserv;
    public $hospcode;

    public function imports_r506($files)
    {
        $sql="LOAD DATA LOCAL INFILE '$files' IGNORE INTO TABLE r506 CHARACTER SET TIS620 FIELDS TERMINATED BY '|';";
        $rs=@$this->db->query($sql);
        return $rs;
    }
}