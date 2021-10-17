<?php

class Anggota_model extends CI_Model
{
    public function getAnggota($id = null)
    {
        if ($id === null) {
            return $this->db->get('anggota')->result_array();
        } else {
            return $this->db->get_where('anggota', ['idAnggota' => $id])->result_array();
        }
    }

    public function deleteAnggota($id)
    {
        $this->db->delete('anggota',['idAnggota' => $id]);
        return $this->db->affected_rows();
    }

    public function createAnggota($data)
    {
        $this->db->insert('anggota', $data);
        return $this->db->affected_rows();
    }

    public function updateAnggota($data,$id)
    {
        $this->db->update('anggota',$data ,['idAnggota' => $id]);
        return $this->db->affected_rows();
    }
}
