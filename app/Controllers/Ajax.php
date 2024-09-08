<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DptModel;

class Ajax extends BaseController
{
  public function searchnik($nik)
  {
    $model = new DptModel;
    $get = $model->find($nik);

    if($get){
      return $this->response->setJSON($get);
    }else{
      return $this->response->setJSON(['status'=>'fail']);
    }
  }
}
