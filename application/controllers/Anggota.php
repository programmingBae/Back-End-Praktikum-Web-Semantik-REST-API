<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;


class Anggota extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'anggota');
    }
    public function index_get()
    {
        $id = $this->get('idAnggota');
        if ($id === null){
            $anggota = $this->anggota->getAnggota();
        } else {
            $anggota = $this->anggota->getAnggota($id);
        }
        if ($anggota){
            $this->response([
                'status' => true,
                'data' => $anggota
            ], RestController::HTTP_OK );
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID Not Found'
            ], RestController::HTTP_NOT_FOUND );
        }
    }

    public function index_delete()
    {
        $id = $this->delete('idAnggota');
        if ($id === null){
            $this->response([
                'status' => false,
                'message' => 'Provide an ID!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->anggota->deleteAnggota($id) > 0){
                // SUCCESS
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Deleted'
                ], RestController::HTTP_OK );
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'ID not found'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        //ASSUME THAT THE DATA RECEIVED ALREADY CLEAN!
        $data = [
            'namaAnggota' => $this->post('namaAnggota'),
            'alamatAnggota' => $this->post('alamatAnggota'),
            'statusKeanggotaan' => $this->post('statusKeanggotaan')
        ];

        if ($this->anggota->createAnggota($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Anggota baru berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambahkan anggota!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        //ASSUME THAT THE DATA RECEIVED ALREADY CLEAN!
        $id = $this->put('idAnggota');
        $data = [
            'namaAnggota' => $this->put('namaAnggota'),
            'alamatAnggota' => $this->put('alamatAnggota'),
            'statusKeanggotaan' => $this->put('statusKeanggotaan')
        ];
        if ($this->anggota->updateAnggota($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Update Failed!'
            ], RestController::HTTP_BAD_REQUEST);
        }

    }


}