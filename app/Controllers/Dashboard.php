<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\UjianModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $ProfileModel = new ProfileModel();
        $UjianModel = new UjianModel();
        $userID = user_id();

        return view('dashboard/index', [
            'user'  => $ProfileModel->getByUserID($userID),
            'mulai' => $UjianModel
                ->selectCount('mulai')
                ->where('SUBSTRING(mulai, 1, 1)', '1')
                ->get()
                ->getRow()->mulai
        ]);
    }

    public function start()
    {
        try {
            $UjianModel = new UjianModel();
            $data = $this->request->getJSON();
            $duration = $data->duration;
            $format = $data->format;

            if ($format == 'minute') {
                $duration = $duration * 60;
            } elseif ($format == 'hour') {
                $duration = $duration * 60 * 60;
            }

            $ujianResults = $UjianModel->select('id')->findAll();

            $UjianIds = array();
            foreach ($ujianResults as $ujian) {
                $UjianIds[] = $ujian['id'];
            }
            
            $updateUjian = $UjianModel
                ->whereIn('id', $UjianIds)
                ->set([
                    'mulai' => 1, 
                    'durasi' => $duration
                ])
                ->update();

            if ($updateUjian) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ujiang telah dimulai',
                    'ujian' => $updateUjian
                ]);
            }
        } catch (\Exception $err) {
            return $this->response->setJSON(['error' => $err->getMessage()]);
        }
    }
}
