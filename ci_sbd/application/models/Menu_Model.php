<?php
class Menu_Model extends CI_Model
{
    function dataObat()
    {
        $this->db->select('*');
        $this->db->from('obat');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataObat($id)
    {
        return $this->db->get_where('obat', ['KodeObat' => $id]);
    }

    public function deleteObat_m($id)
    {
        $this->db->where('KodeObat', $id);
        $this->db->delete('obat');
    }

    function dataPersediaan()
    {
        $this->db->select('*');
        $this->db->from('persediaan');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function updatePersediaan($id, $data)
    {
        $this->db->where('KodeObat', $id);
        $this->db->update('persediaan', $data);
    }

    public function getPersediaan($id)
    {
        return $this->db->get_where('persediaan', ['KodeObat' => $id]);
    }

    public function deletePersediaan_m($id)
    {
        $this->db->where('KodeObat', $id);
        $this->db->delete('persediaan');
    }

    public function addPersediaan($data)
    {
        $this->db->insert('persediaan', $data);
    }

    public function dataAllPenjualan()
    {
        return $this->db->query('
            SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penjanuari 
            UNION SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penfebruari 
            UNION SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penmaret 
            ORDER BY TglTransaksi;
            ')->result_array();
    }
    public function dataPenJanuari()
    {
        return $this->db->get('penjanuari')->result_array();
    }
    public function getJanuari($id)
    {
        return $this->db->get_where('penjanuari', [
            'id' => $id
        ]);
    }
    public function updateJan($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penjanuari', $data);
    }
    public function deletePenJanuari_m($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penjanuari');
    }


    public function dataPenFebruari()
    {
        return $this->db->get('penfebruari')->result_array();
    }
    public function getFebruari($id)
    {
        return $this->db->get_where('penfebruari', [
            'id' => $id
        ]);
    }
    public function updateFeb($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penfebruari', $data);
    }
    public function deletePenFebruari_m($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penfebruari');
    }


    public function dataPenMaret()
    {
        return $this->db->get('penmaret')->result_array();
    }
    public function getMaret($id)
    {
        return $this->db->get_where('penmaret', [
            'id' => $id
        ]);
    }
    public function updateMar($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penmaret', $data);
    }
    public function deletePenMaret_m($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penmaret');
    }
    public function dataPenApril()
    {
        return $this->db->get('penapril')->result_array();
    }
    public function getApril($id)
    {
        return $this->db->get_where('penapril', [
            'id' => $id
        ]);
    }
    public function updateApr($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penapril', $data);
    }
    public function deletePenApril_m($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penapril');
    }
}
