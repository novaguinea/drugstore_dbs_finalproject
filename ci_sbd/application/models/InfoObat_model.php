<?php
class infoObat_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('obat')->result_array();
    }
    public function get_product_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->like('KodeObat', $keyword);
        $this->db->or_like('NamaObat', $keyword);
        return $this->db->get()->result();
    }
}
