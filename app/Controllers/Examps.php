<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelompokModel;
use App\Models\NilaiModel;
use App\Models\ProfileModel;
use App\Models\UjianModel;
use App\Models\SoalModel;
use App\Models\TopikModel;

class Examps extends BaseController
{
    public $KelompokModel;
    public $ProfileModel;
    public $UjianModel;
    public $SoalModel;
    public $TopikModel;
    public $session;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
        $this->KelompokModel = new KelompokModel();
        $this->UjianModel = new UjianModel();
        $this->SoalModel = new SoalModel();
        $this->TopikModel = new TopikModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $topikSession = $this->session->get('topik');
        if (isset($topikSession)) {
            return redirect()->to("examp/ujian/".bin2hex($topikSession)."");
        } else {
            $userID = user_id();
            $user = $this->ProfileModel->getByUserID($userID);

            $kelompok = $this->ProfileModel
                ->select('profile.kelompok_id, kelompok.name')
                ->join('kelompok', 'profile.kelompok_id = kelompok.id')
                ->where('profile.id', $userID)
                ->first();

                
            if ($kelompok) {
                $ujian = $this->UjianModel->where('kelompok', $kelompok['name'])->findAll();
                $NilaiModel = new NilaiModel();
                $cekNilai = $NilaiModel
                            ->where('name', $user['nama'])
                            ->where('topik', $ujian[0]['topik'] ?? 0);
            
                $this->session->set([
                    'kelompok' => $kelompok,
                    'cekNilai'=> $cekNilai->countAllResults()
                ]);

                return view('user/index', [
                    'user' => $user,
                    'kelompok' => $kelompok,
                    'ujians' => $ujian,
                    'session' => $this->session->get('topik') ?? null,
                    'cekNilai' => $cekNilai->countAllResults(),
                    'hasilUjian' => $cekNilai->select('nilai, created_at')->first() ?? null
                ]);
            }
        }
    }

    public function ujian($name)
    {
        $name = hex2bin($name);
        $userID = user_id();
        $user = $this->ProfileModel->getByUserID($userID);

        $topik = $this->TopikModel->select('id, name')->where('name', $name)->first();

        if (!$topik) {
            return redirect()->to('/examp');
        }

        if ($name == $topik['name']) {
            $this->session->set('topik', $name);
        }

        $data = [
            'user' => $user,
            'soals' => $this->SoalModel->where('topik_id', $topik['id'])->findAll(),
            'jumlahSoal' => $this->SoalModel->where('topik_id', $topik['id'])->countAllResults(),
            'topik' => $name,
            'kelompok' => $this->session->get('kelompok'),
            'CountDown' => $this->CountDown(intval($this->UjianModel->select('durasi')->first()['durasi']))
        ];
        
        if ($this->session->get('cekNilai') != 0) {
            $this->session->remove('topik');
            return redirect()->to('/examp');
        }
        
        return view('user/ujian', $data);
    }

    public function selesai()
    {
        $this->session->remove('countdown');
        try {
            $jawaban = $this->request->getJSON();
            $nilai = 0;

            $soalJawaban = [];
            foreach ($jawaban as $soalID => $value) {
                $soal = $this->SoalModel->select('value_a, value_b, value_c, value_d')->find($soalID);
                $soalJawaban[] = $soal;

                $value = hex2bin($value);
                if (
                    $value == $soal['value_a'] ||
                    $value == $soal['value_b'] ||
                    $value == $soal['value_c'] ||
                    $value == $soal['value_d']
                ) {
                    $nilai += $value;
                }
            }

            $NilaiModel = new NilaiModel();
            $user = $this->ProfileModel->select('nama, kelompok_id')->where('user_id', user_id())->first();
            $kelompok = $this->KelompokModel->select('name')->where('id', $user['kelompok_id'])->first();
            
            $data = [
                'name' => $user['nama'],
                'kelompok' => $kelompok['name'],
                'topik' => $this->session->get('topik'),
                'nilai' => $nilai
            ];

            if ($NilaiModel->insert($data)) {
                $this->session->remove('countdown');
                $this->session->remove('topik');
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Nilai Anda telah disimpan',
                    'redirect' => '/examp'
                ]);
            } else {
                return $this->response->setJSON(['message' => 'Terjadi kesalahan saat menyimpan nilai']);
            }

        } catch (\Exception $err) {
            return $this->response->setJSON(['err' => $err->getMessage()]);
        }
    }

    public function CountDown($time)
    {
        if (!$this->session->has('countdown')) {
            $currentTime = time();
            $targetTime = $currentTime + $time;
            
            $this->session->set('countdown', $targetTime);
        }

        $targetTime = $this->session->get('countdown');
        $currentTime = time();
        $countdown = $targetTime - $currentTime;

        return $countdown;
    }
}
