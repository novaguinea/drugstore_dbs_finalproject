<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Stok Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('tkodeobat', 'Kode', 'trim|required');
        $this->form_validation->set_rules('tnamaobat', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tbentukobat', 'Bentuk', 'trim|required');
        $this->form_validation->set_rules('tproduksiobat', 'TglProduksi', 'trim|required');
        $this->form_validation->set_rules('tkadaluarsaobat', 'TglKadaluarsa', 'trim|required');
        $this->form_validation->set_rules('thargasatuan', 'Harga', 'trim|required');


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->form_validation->run() ==  true) {

            $data = [
                'KodeObat' => $this->input->post('tkodeobat'),
                'NamaObat' => $this->input->post('tnamaobat'),
                'BentukObat' => $this->input->post('tbentukobat'),
                'TglProduksi' => $this->input->post('tproduksiobat'),
                'TglKadaluarsa' => $this->input->post('tkadaluarsaobat'),
                'HargaSatuan' => $this->input->post('thargasatuan')
            ];

            $this->db->insert('obat', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            New Product Added!
            </div>'
            );
            redirect('menu');
        }
    }

    public function view()
    {
    }

    public function addProduct()
    {
    }
}
