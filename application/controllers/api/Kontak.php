<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->get('id');

        if ($id == '') {
            $kontak['data'] = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);

            $kontak['data'] = $this->db->get('telepon')->result();
        }

        return $this->response($kontak, 200);
    }

    function index_post() {
        if ($this->post('method') == 'PUT') {
            $id = $this->post('id');

            $data = array(
                'id'    => $this->post('id'),
                'nama'  => $this->post('nama'),
                'nomor' => $this->post('nomor'),
                'foto'  => 'user4-128x128.jpg', //$this->post('foto'),
                '_foto'  => $this->post('_foto'),
            );

            if ($data['foto'] == '') {
                $data['foto'] = $data['_foto'];
            }

            unset($data['_foto']);

            $this->db->where('id', $id);

            $update = $this->db->update('telepon', $data);

            if ($update) {
                return $this->response($data, 200);
            } else {
                return $this->response(array('status' => 'fail', 502));
            }
        }

        if ($this->post('method') == 'DELETE') {
            $id = $this->post('id');

            $this->db->where('id', $id);

            $delete = $this->db->delete('telepon');

            if ($delete) {
                return $this->response(array('status' => 'success'), 201);
            } else {
                return $this->response(array('status' => 'fail', 502));
            }
        }

        $data = array(
            'id'    => $this->post('id'),
            'nama'  => $this->post('nama'),
            'nomor' => $this->post('nomor'),
            'foto'  => 'user4-128x128.jpg', //$this->post('foto'),
        );

        $insert = $this->db->insert('telepon', $data);

        if ($insert) {
            return $this->response($data, 200);
        } else {
            return $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');

        $data = array(
            'id'    => $this->put('id'),
            'nama'  => $this->put('nama'),
            'nomor' => $this->put('nomor'),
            'foto'  => $this->put('foto'),
        );

        $this->db->where('id', $id);

        $update = $this->db->update('telepon', $data);

        if ($update) {
            return $this->response($data, 200);
        } else {
            return $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');

        $this->db->where('id', $id);

        $delete = $this->db->delete('telepon');

        if ($delete) {
            return $this->response(array('status' => 'success'), 201);
        } else {
            return $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
