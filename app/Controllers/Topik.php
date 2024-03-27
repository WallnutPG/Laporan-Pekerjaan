<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\TopikModel;


class Topik extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use RequestTrait;

    public $model;

    public function __construct() {
        $this->model = new TopikModel();
    }

    public function index()
    {
        $data['topiks'] = $this->model->findAll();
        return view('soal/index', $data);
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
        $name = $this->request->getJSON('name');

        if (empty($name)) {
            return $this->fail('Nama topik tidak boleh kosong.');
        }

        $data = [
            'name' => $name
        ];

        if ($this->model->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status' => 201,
                'message' => "Berhasil menambahkan topik."
            ]);
        } else {
            return $this->fail('Gagal menambahkan topik.');
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
        if ($id === null) {
            return $this->fail('ID tidak valid');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Topik berhasil dihapus'
            ]);
        } else {
            return $this->fail('Gagal menghapus topik');
        }
    }
}
