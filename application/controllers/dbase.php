<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Basic Controller
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Dbase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //$this->load->model('Basic_model', 'basic');
    }

    public function get_ep2main()
    {

        echo " Load Dbf";
        // open in read-only mode
        $db = dbase_open('/upload/DATAr506_20140101_20140614.dbf', 0);

        if ($db) {
            // read some data ..

            dbase_close($db);
        }
    }

}

/* End of file basic.php */
/* Location: ./application/controlers/basic.php */