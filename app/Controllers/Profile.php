<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;

class Profile extends BaseController
{
    protected $model;

    public function __construct() {
        $this->model = new ProfileModel();
    }

    public function getUserProfile()
    {
        return $this->model->getByUserID(user_id());
    }
}
