<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\KelompokModel;
use Myth\Auth\Models\UserModel;

class Peserta extends BaseController
{
    public $KelompokModel;
    public $ProfileModel;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
        $this->KelompokModel = new KelompokModel();
    }

    public function index()
    {
        $pager = \Config\Services::pager();
        $currentPage = $this->request->getPost('page') ?? 1;
        $perPage = $this->request->getPost('perpage') ?? 10;

        $offset = ($currentPage - 1) * $perPage;

        $profilesId = $this->ProfileModel->select('id')->findAll();
        $kelompokID = array_column($profilesId, 'id');

        $profilesQuery = $this->ProfileModel
            ->select('profile.id, profile.nama as nama, profile.user_id, kelompok.name as kelompok')
            ->join('kelompok', 'profile.kelompok_id = kelompok.id', 'left')
            ->whereIn('profile.id', $kelompokID)
            ->limit($perPage, $offset);

        $profiles = $profilesQuery->paginate($perPage, 'default_full');

        $totalRows = count($kelompokID);

        $pagination = $pager->makeLinks($currentPage, $perPage, $totalRows, 'default_full');

        $data = [
            'profiles' => $profiles,
            'kelompoks' => $this->KelompokModel->select('*')->findAll(),
            'pagination' => $pagination,
            'current_page' => $currentPage
        ];

        return view('peserta/index', $data);
    }

    public function pagination()
    {
        $currentPage = $this->request->getJSON()->page ?? 1;
        $perPage = 10;

        $offset = ($currentPage - 1) * $perPage;

        $profilesId = $this->ProfileModel->select('id')->findAll();
        $kelompokID = array_column($profilesId, 'id');

        $profilesQuery = $this->ProfileModel
            ->select('profile.id, profile.nama as nama, profile.user_id, kelompok.name as kelompok')
            ->join('kelompok', 'profile.kelompok_id = kelompok.id', 'left')
            ->whereIn('profile.id', $kelompokID)
            ->limit($perPage, $offset);

        $profiles = $profilesQuery->paginate($perPage, 'default_full');

        $totalRows = count($kelompokID);
        $dataProfiles = [];

        foreach ($profiles as $profile) {
            $dataProfiles[] = [
                'id' => $profile['id'],
                'nama' => $profile['nama'],
                'user_id' => $profile['user_id'],
                'kelompok' => $profile['kelompok']
            ];
        }

        $paginationData = [
            'current_page' => $currentPage,
            'total_rows' => $totalRows,
            'per_page' => $perPage,
        ];

        $data = [
            'profiles' => $dataProfiles,
            'pagination' => $paginationData
        ];

        return $this->response->setJSON($data);
    }

    public function removePeserta()
    {
        $id = $this->request->getJSON('id');

        $userModel = new UserModel();

        try {
            if ($userModel->where('id', $id)->delete()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }


    public function addKelompok()
    {
        if ($this->KelompokModel->insert(['name' => $this->request->getPost('nama')])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menambahkan kelompok'
            ]);
        }
    }

    public function removeKelompok()
    {
        $id = $this->request->getJSON('id');

        try {
            if ($this->KelompokModel->where('id', $id)->delete()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
