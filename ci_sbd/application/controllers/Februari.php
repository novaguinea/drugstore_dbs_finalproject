<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Februari extends CI_Controller
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

            $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
            $this->form_validation->set_rules('transaksi', 'Tgl Transaksi', 'trim|required');
            $this->form_validation->set_rules('terjual', 'Jumlah Terjual', 'trim|required');

            $data = [
                'KodeObat' => $this->input->post('tkodeobat'),
                'TglTransaksi' => $this->input->post('transaksi'),
                'Jumlah_Terjual' => $this->input->post('terjual')
            ];

            $this->db->insert('penfebruari', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    New product successfully added!
                </div>'
            );
            redirect('menu/februari');
        }
    }
}
