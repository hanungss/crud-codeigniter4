<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;

class Post extends Controller
{
    /**
     * index function
     */
    public function index()
    {
        //model initialize
        $postModel = new PostModel();

        //pager initialize
        $pager = \Config\Services::pager();

        $data = array(
            'user' => $postModel->paginate(2, 'post'),
            'pager' => $postModel->pager
        );

        return view('post-index', $data);
    }

    /**
     * create function
     */
    public function create()
    {
        return view('post-create');
    }

    /**
     * store function
     */
    public function store()
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama User.'
                ]
            ],
            'posisi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Posisi User.'
                ]
            ],
        ]);

        if(!$validation) {

            //render view with error validation message
            return view('post-create', [
                'validation' => $this->validator
            ]);

        } else {

            //model initialize
            $postModel = new PostModel();
            
            //insert data into database
            $postModel->insert([
                'nama'   => $this->request->getPost('nama'),
                'posisi' => $this->request->getPost('posisi'),
            ]);

            //flash message
            session()->setFlashdata('message', 'User Berhasil Disimpan');

            return redirect()->to(base_url('./crud-ci4/public'));
        }

    }

    /**
     * edit function
     */
    public function edit($id)
    {
        //model initialize
        $postModel = new PostModel();

        $data = array(
            'get' => $postModel->find($id)
        );

        return view('post-edit', $data);
    }

    /**
     * update function
     */
    public function update($id)
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama.'
                ]
            ],
            'posisi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Posisi.'
                ]
            ],
        ]);

        if(!$validation) {

            //model initialize
            $postModel = new PostModel();

            //render view with error validation message
            return view('post-edit', [
                'post' => $postModel->find($id),
                'validation' => $this->validator
            ]);

        } else {

            //model initialize
            $postModel = new PostModel();
            
            //insert data into database
            $postModel->update($id, [
                'nama'   => $this->request->getPost('nama'),
                'posisi' => $this->request->getPost('posisi'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Post Berhasil Diupdate');

            return redirect()->to(base_url('./crud-ci4/public'));
        }

    }

    public function delete($id)
    {
        //model initialize
        $postModel = new PostModel();

        $post = $postModel->find($id);

        if($post) {
            $postModel->delete($id);

            //flash message
            session()->setFlashdata('message', 'Nama Berhasil Dihapus');

            return redirect()->to(base_url('./crud-ci4/public'));
        }
    }
    
}