<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }
    public function detail($slug)
    {
        $muku = $this->komikModel->getKomik($slug);
        $data = [
            'title' => "Detail Komik",
            'komik' => $muku
        ];
        if ($muku != null){

            return view('komik/detail', $data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data',
            'validation' =>  \Config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => 'required|is_unique[komik.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => 'required'
        ])) {
            $validation =  \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/komik');
    }
    
    public function delete($id){
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form ubah Data',
            'validation' =>  \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];
  
  return view('komik/edit', $data);
    }

    public function update($id){
        if (!$this->validate([
            'judul' => 'required|is_unique[komik.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => 'required'
        ])) {
            $validation =  \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/komik');
    }
}
