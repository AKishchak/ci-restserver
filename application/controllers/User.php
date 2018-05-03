<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {
var $table1 = 'user_review';

	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $data = $this->db->get($this->table1)->result();
        } else {
            $this->db->where('id', $id);
            $data = $this->db->get($this->table1)->result();
        }
        $this->response($data, 200);
    }

    
function index_post() {
        $data = array(

                    	'id'       		=> $this->post('id'),
                    	'order_id'     	=> $this->post('order_id'),
                    	'product_id' 	=> $this->post('product_id'),
                    	'user_id'		=> $this->post('user_id'),
                    	'rating'		=> $this->post('rating'),
                    	'review'		=> $this->post('review'),
                    	'created_at'	=> date("Y/m/d h:i:s"),
                    	'update_at'		=> date("Y/m/d h:i:s")
                    );
        
        $insert = $this->db->insert('user_review', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

function index_put() {
        $id = $this->put('id');
        
        $data = array(

                    	'id'       		=> $this->post('id'),
                    	'order_id'     	=> $this->post('order_id'),
                    	'product_id' 	=> $this->post('product_id'),
                    	'user_id'		=> $this->post('user_id'),
                    	'rating'		=> $this->post('rating'),
                    	'review'		=> $this->post('review'),
                    	'update_at'		=> date("Y/m/d h:i:s")
                    );

        $this->db->where('id', $id);
        $update = $this->db->update('user_review', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user_review');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }



    



}

/* End of file  */
/* Location: ./application/controllers/ */