<?php

class Buku extends CI_Controller
{
    public function kategori()
    {
        $data['judul'] = 'Kategori Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

        $this->form_validation->set_rules(
            'kategori',
            'Kategori',
            'required',
            [
                'required' => 'Judul Buku Harus Diisi'
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];

            $this->ModelBuku->simpankategori($data);
            redirect('buku/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusKategori($where);
        redirect('buku/kategori');
    }
}
