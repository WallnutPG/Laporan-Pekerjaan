<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\TopikModel;
use App\Models\KelompokModel;
use App\Models\UjianModel;

class Ujian extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use RequestTrait;

    public $TopikModel;
    public $KelompokModel;
    public $UjianModel;

    public function __construct() 
    {
        $this->TopikModel = new TopikModel();
        $this->KelompokModel = new KelompokModel();
        $this->UjianModel = new UjianModel();
    }

    public function index()
    {
        $data['topiks'] = $this->TopikModel->findAll();
        $data['kelompoks'] = $this->KelompokModel->findAll();
        $data['ujians'] = $this->UjianModel->findAll();
        
        return view('ujian/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost();

        if ($this->UjianModel->insert($data)) {
            return redirect()->to('dashboard/ujian')->with('message', 'Berhasil menambahkan ujian');

        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
