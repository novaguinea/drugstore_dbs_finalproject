<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_Model');
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

    function updateHarga($id)
    {
        $data['title'] = 'Update Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['obat'] = $this->Menu_Model->getDataObat($id)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/updateHarga', $data);
        $this->load->view('templates/footer');
    }

    public function updateHargaController()
    {
        $data['title'] = 'Update Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['product'] = $this->db->get('obat');

        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('thargasatuan', 'Harga Satuan', 'trim|required');
        $hargaUpdate = [
            'KodeObat' => $this->input->post('tkodeobat'),
            'HargaSatuan' => $this->input->post('thargasatuan')
        ];
        $this->db->insert('updateobat', $hargaUpdate);

        $yay = "Data Obat berhasil di UPDATE! | ";
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d/m/Y  h:i:s a ');
        $date_word = "| Dimodifikasi : " . $date;
        $host = " | | Nama Host : " . $data['user']['name'] . " | | ";

        $arows = $this->db->affected_rows();
        $rows_word = $arows . " row(s) affected.";

        $alert = $yay . $date_word . $host . $rows_word;
        $this->session->set_flashdata(
            'message',
            $alert
        );

        redirect('menu');
    }

    public function deleteObat($id)
    {
        $this->Menu_Model->deleteObat_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Obat successfully deleted!
            </div>'
        );
        redirect('menu/index');
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

    public function persediaan()
    {
        $data['title'] = 'Persediaan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/persediaan', $data);
        $this->load->view('templates/footer');
    }

    function januari()
    {
        $data['title'] = 'Penjualan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/januari', $data);
            $this->load->view('templates/footer');
        } else {
            //$data = $this->db->get('penjanuari');
            $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
            $this->form_validation->set_rules('transaksi', 'Tgl Transaksi', 'trim|required');
            $this->form_validation->set_rules('terjual', 'Jumlah Terjual', 'trim|required');

            $add = [
                'KodeObat' => $this->input->post('tkodeobat'),
                'TglTransaksi' => $this->input->post('transaksi'),
                'Jumlah_Terjual' => $this->input->post('terjual')
            ];

            $this->db->insert('penjanuari', $add);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    New product successfully added!
                </div>'
            );
            redirect('menu');
        }
    }

    public function deletePenJanuari($id)
    {
        $this->Menu_Model->deletePenJanuari_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Penjualan successfully deleted!
            </div>'
        );
        redirect('menu/januari');
    }

    public function editJanuari($id)
    {
        $data['title'] = 'Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['obat'] = $this->Menu_Model->getJanuari($id)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editJan', $data);
        $this->load->view('templates/footer');
    }
    public function editJanuariController()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('transaksi', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('jmlterjual', 'Jumlah Terjual', 'trim|required');

        $update = [
            'id' => $this->input->post('id'),
            'KodeObat' => $this->input->post('tkodeobat'),
            'TglTransaksi' => $this->input->post('transaksi'),
            'Jumlah_Terjual' => $this->input->post('jmlterjual')
        ];

        $this->Menu_Model->updateJan($update['id'], $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Penjualan Berhasil di UPDATE!
            </div>'
        );

        redirect('menu/januari');
    }


    function februari()
    {
        $data['title'] = 'Penjualan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/februari', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->db->get('penfebruari');

            $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
            $this->form_validation->set_rules('transaksi', 'Tgl Transaksi', 'trim|required');
            $this->form_validation->set_rules('terjual', 'Jumlah Terjual', 'trim|required');

            $transaksi = [
                'KodeObat' => $this->input->post('tkodeobat'),
                'TglTransaksi' => $this->input->post('transaksi'),
                'Jumlah_Terjual' => $this->input->post('terjual')
            ];

            $this->db->insert('penfebruari', $transaksi);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    New product successfully added!
                </div>'
            );
            redirect('menu');
        }
    }
    public function deletePenFebruari($id)
    {
        $this->Menu_Model->deletePenFebruari_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Penjualan successfully deleted!
            </div>'
        );
        redirect('menu/februari');
    }

    public function editFebruari($id)
    {
        $data['title'] = 'Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['obat'] = $this->Menu_Model->getFebruari($id)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editFeb', $data);
        $this->load->view('templates/footer');
    }
    public function editFebruariController()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('transaksi', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('jmlterjual', 'Jumlah Terjual', 'trim|required');

        $update = [
            'id' => $this->input->post('id'),
            'KodeObat' => $this->input->post('tkodeobat'),
            'TglTransaksi' => $this->input->post('transaksi'),
            'Jumlah_Terjual' => $this->input->post('jmlterjual')
        ];

        $this->Menu_Model->updateFeb($update['id'], $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Penjualan Berhasil di UPDATE!
            </div>'
        );

        redirect('menu/februari');
    }


    function maret()
    {
        $data['title'] = 'Penjualan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/maret', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->db->get('penmaret');
            redirect('menu');
        }
    }
    public function deletePenMaret($id)
    {
        $this->Menu_Model->deletePenMaret_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Penjualan successfully deleted!
            </div>'
        );
        redirect('menu/maret');
    }

    public function editMaret($id)
    {
        $data['title'] = 'Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['obat'] = $this->Menu_Model->getMaret($id)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editFeb', $data);
        $this->load->view('templates/footer');
    }
    public function editMaretController()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('transaksi', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('jmlterjual', 'Jumlah Terjual', 'trim|required');

        $update = [
            'id' => $this->input->post('id'),
            'KodeObat' => $this->input->post('tkodeobat'),
            'TglTransaksi' => $this->input->post('transaksi'),
            'Jumlah_Terjual' => $this->input->post('jmlterjual')
        ];

        $this->Menu_Model->updateMar($update['id'], $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Penjualan Berhasil di UPDATE!
            </div>'
        );

        redirect('menu/maret');
    }

    function april()
    {
        $data['title'] = 'Penjualan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/april', $data);
            $this->load->view('templates/footer');
        } else {
            //$data = $this->db->get('penjanuari');
            $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
            $this->form_validation->set_rules('transaksi', 'Tgl Transaksi', 'trim|required');
            $this->form_validation->set_rules('terjual', 'Jumlah Terjual', 'trim|required');

            $add = [
                'KodeObat' => $this->input->post('tkodeobat'),
                'TglTransaksi' => $this->input->post('transaksi'),
                'Jumlah_Terjual' => $this->input->post('terjual')
            ];

            $this->db->insert('penapril', $add);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    New product successfully added!
                </div>'
            );
            redirect('menu');
        }
    }

    public function deletePenApril($id)
    {
        $this->Menu_Model->deletePenApril_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Penjualan successfully deleted!
            </div>'
        );
        redirect('menu/april');
    }

    public function editApril($id)
    {
        $data['title'] = 'Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['obat'] = $this->Menu_Model->getApril($id)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editJan', $data);
        $this->load->view('templates/footer');
    }
    public function editAprilController()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('transaksi', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('jmlterjual', 'Jumlah Terjual', 'trim|required');

        $update = [
            'id' => $this->input->post('id'),
            'KodeObat' => $this->input->post('tkodeobat'),
            'TglTransaksi' => $this->input->post('transaksi'),
            'Jumlah_Terjual' => $this->input->post('jmlterjual')
        ];

        $this->Menu_Model->updateApr($update['id'], $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Penjualan Berhasil di UPDATE!
            </div>'
        );

        redirect('menu/april');
    }


    public function penjualan()
    {
        $data['title'] = 'Penjualan Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/penjualan', $data);
            $this->load->view('templates/footer');
        } else {

            $data['penjualan'] = $this->db->query('
                SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penjanuari 
                UNION SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penfebruari 
                UNION SELECT KodeObat, TglTransaksi, Jumlah_Terjual FROM penmaret 
                ORDER BY TglTransaksi;
                ');
            redirect('menu');
        }
    }

    public function infoObat()
    {
        $data['title'] = 'Stok Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/infoObat', $data);
        $this->load->view('templates/footer');
    }



    public function exportMember()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->db->query(
            'SELECT `obat`.`KodeObat`, `NamaObat`, `BentukObat`, `TglProduksi`, `TglKadaluarsa`, `HargaSatuan`, `JumlahSedia` 
        FROM `obat`, `persediaan` WHERE `obat`.`KodeObat` = `persediaan`.`KodeObat`
        ORDER BY `obat`.`KodeObat` ASC'
        )->result_array();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Info Obat");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Bentuk Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tgl Produksi');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tgl Kadaluarsa');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Harga Satuan');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Stok Obat');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['NamaObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['BentukObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $data['TglProduksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $data['TglKadaluarsa']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $data['HargaSatuan']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $data['JumlahSedia']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Data Obat");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportDetailObat()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataObat();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Info Obat");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Bentuk Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tgl Produksi');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tgl Kadaluarsa');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Harga Satuan');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['NamaObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['BentukObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $data['TglProduksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $data['TglKadaluarsa']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $data['HargaSatuan']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Data Obat");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportUpdateObat()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataUpdateObat();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Info Obat");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Harga Satuan');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['HargaSatuan']);

            $row++;
            $no++;
        }

        $filename = "Update_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Update Obat");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportPersediaan()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataPersediaan();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Persediaan Obat");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Jumlah Sedia');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['JumlahSedia']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Persediaan Obat");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportAllPenjualan()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataAllPenjualan();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("All Penjualan Obat");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal Transaksi');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Terjual');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['TglTransaksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['Jumlah_Terjual']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Penjualan Obat");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportPenjualan_Jan()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataPenJanuari();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Penjualan Obat Januari");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal Transaksi');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Terjual');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['TglTransaksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['Jumlah_Terjual']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Penjualan Obat Januari");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportPenjualan_Feb()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataPenJanuari();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Penjualan Obat Februari");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal Transaksi');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Terjual');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['TglTransaksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['Jumlah_Terjual']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Penjualan Obat Februari");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
    public function exportPenjualan_Mar()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataPenMaret();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Penjualan Obat Maret");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal Transaksi');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Terjual');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['TglTransaksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['Jumlah_Terjual']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Penjualan Obat Maret");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }

    public function exportPenjualan_Apr()
    {
        //$this->load->library('PHPExcel/IOfactory');

        $obat = $this->Menu_Model->dataPenApril();

        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');


        //require_once 'Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Kelompok SBD");
        $objPHPExcel->getProperties()->setLastModifiedBy("Kelompok SBD");
        $objPHPExcel->getProperties()->setTitle("Penjualan Obat April");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kode Obat');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal Transaksi');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Terjual');

        $row = 2;
        $no = 1;

        foreach ($obat as $data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $data['KodeObat']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $data['TglTransaksi']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $data['Jumlah_Terjual']);

            $row++;
            $no++;
        }

        $filename = "Data_Obat" . date("d-m-Y-H-i-s") . '.xlsx';

        $objPHPExcel->getActiveSheet()->setTitle("Penjualan Obat April");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposistion: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');

        exit;
    }

    public function editPersediaan($id)
    {
        $data['title'] = 'Edit Stok Obat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //$id = $this->load->input->post('id')->row_array();
        $data['persediaan'] = $this->Menu_Model->getPersediaan($id)->row_array();
        //$data = ['data_persediaan' => $persediaan_model];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/editPersediaan', $data);
        $this->load->view('templates/footer');
        //var_dump($data);*/
    }

    public function editPersediaanController()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('tjumlahsedia', 'Jumlah Sedia', 'trim|required');

        $updateStok = [
            'KodeObat' => $this->input->post('tkodeobat'),
            'JumlahSedia' => $this->input->post('tjumlahsedia')
        ];

        $this->Menu_Model->updatePersediaan($updateStok['KodeObat'], $updateStok);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Persediaan Berhasil di UPDATE!
            </div>'
        );

        redirect('menu/persediaan');
    }

    public function deletePersediaan($id)
    {
        $this->Menu_Model->deletePersediaan_m($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning" role="alert">
                Data Persediaan successfully deleted!
            </div>'
        );
        redirect('menu/persediaan');
    }

    public function addPersediaan()
    {
        $this->form_validation->set_rules('tkodeobat', 'Kode Obat', 'trim|required');
        $this->form_validation->set_rules('tjumlahsedia', 'Jumlah Sedia', 'trim|required');

        $addStok = [
            'KodeObat' => $this->input->post('tkodeobat'),
            'JumlahSedia' => $this->input->post('tjumlahsedia')
        ];

        $this->Menu_Model->addPersediaan($addStok);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Persediaan Berhasil DITAMBAHKAN!
            </div>'
        );

        redirect('menu/persediaan');
    }

    public function backup()
    {
        $this->load->dbutil();

        $pref = [
            'format' => 'sql',
            'filename' => "apotek_" . date("Ymd-His") . ".sql"
        ];

        $backup = &$this->dbutil->backup($pref);
        date_default_timezone_set('Asia/Jakarta');
        $db_name = "apotek_" . date("Y-m-d-H-i-s") . ".sql";
        $save = 'menu/db' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);

        exit;
    }
}
