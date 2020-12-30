<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Stok Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->form_validation->run() ==  true) {

            $this->form_validation->set_rules('tnamaobat', 'Nama', 'trim|required');
            $this->form_validation->set_rules('tbentukobat', 'Bentuk', 'trim|required');
            $this->form_validation->set_rules('tproduksiobat', 'TglProduksi', 'trim|required');
            $this->form_validation->set_rules('tkadaluarsaobat', 'TglKadaluarsa', 'trim|required');
            $this->form_validation->set_rules('thargasatuan', 'Harga Satuan', 'trim|required');

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
                    New product successfully added!
                </div>'
            );
            redirect('menu');
        }
    }

    function updateHarga()
    {

        $data['product'] = $this->db->get('obat');
        $kodeView = $this->input->post('tkodeobat');
        //$KodeObat = $this->db->get_where('obat', ['KodeObat' => $kodeView])->row_array(); //mencari 

        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('thargasatuan', 'Harga Satuan', 'trim|required');
        $hargaUpdate = [
            'KodeObat' => $this->input->post('tkodeobat'),
            'HargaSatuan' => $this->input->post('thargasatuan')
        ];
        $this->db->insert('updateobat', $hargaUpdate);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Obat Berhasil di UPDATE!
            </div>'
        );

        redirect('menu');
    }

    function addProduct()
    {
        $ci = &get_instance();
        $ci->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $ci->form_validation->set_rules('tnamaobat', 'Nama', 'trim|required');
        $ci->form_validation->set_rules('tbentukobat', 'Bentuk', 'trim|required');
        $ci->form_validation->set_rules('tproduksiobat', 'TglProduksi', 'trim|required');
        $ci->form_validation->set_rules('tkadaluarsaobat', 'TglKadaluarsa', 'trim|required');
        $ci->form_validation->set_rules('thargasatuan', 'Harga Satuan', 'trim|required');

        $data = [
            'KodeObat' => $ci->input->post('tkodeobat'),
            'NamaObat' => $ci->input->post('tnamaobat'),
            'BentukObat' => $ci->input->post('tbentukobat'),
            'TglProduksi' => $ci->input->post('tproduksiobat'),
            'TglKadaluarsa' => $ci->input->post('tkadaluarsaobat'),
            'HargaSatuan' => $ci->input->post('thargasatuan')
        ];

        $ci->db->insert('obat', $data);

        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
        New Product Added!
        </div>'
        );
        redirect('menu');
    }
}
