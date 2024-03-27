<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\SoalModel;
use App\Models\TopikModel;

class Soal extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use RequestTrait;

    public $SoalModel;
    public $TopikModel;

    public function __construct()
    {
        $this->SoalModel = new SoalModel();
        $this->TopikModel = new TopikModel();
    }

    public function index()
    {
        $pager = \Config\Services::pager(); // Impor kelas pager

        $currentPage = $this->request->getPost('page') ?? 1;
        $perPage = $this->request->getPost('perpage') ?? 10;
        $offset = ($currentPage - 1) * $perPage;

        $soals = $this->SoalModel
            ->select('soal.id, soal.question, soal.topik_id, topik.name as topik_name')
            ->join('topik', 'soal.topik_id = topik.id', 'left')
            ->limit($perPage, $offset)
            ->get()
            ->getResult();

        $totalRows = $this->SoalModel->countAll(); // Hitung total jumlah baris

        $pagination = $pager->makeLinks($currentPage, $perPage, $totalRows); // Buat data pagination

        $data = [
            'soals' => $soals,
            'topiks' => $this->TopikModel->findAll(),
            'pagination' => $pagination
        ];

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
        try {
            $data = $this->request->getJSON();

            $result = $this->SoalModel->insert($data);

            if ($result) {
                return $this->respondCreated([
                    'status' => 200,
                    'message' => "Berhasil menambahkan soal !"
                ]);
            } else {
                return $this->fail('Gagal menambahkan soal !');
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()]);
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
        try {
            if ($id === null) {
                return $this->fail('ID tidak valid');
            }

            $deleted = $this->SoalModel->delete($id);

            if ($deleted) {
                return $this->respondDeleted([
                    'status' => 200,
                    'message' => 'Soal berhasil dihapus'
                ]);
            } else {
                return $this->fail('Gagal menghapus soal');
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()]);
        }
    }
}
