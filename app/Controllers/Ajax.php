<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DptModel;
use App\Models\RelawanModel;

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

  public function detailRelawan($id)
  {
    $model = new RelawanModel;
    $find = $model->find($id);

    echo '
    <table class="table table-striped">
      <tr>
        <td>NIK</td>
        <td>'.$find->nik.'</td>
      </tr>
      <tr>
        <td>NKK</td>
        <td>'.$find->nkk.'</td>
      </tr>
      <tr>
        <td>NAMA</td>
        <td>'.$find->nama.'</td>
      </tr>
      <tr>
        <td>JENIS KELAMIN</td>
        <td>'.$find->jenis_kelamin.'</td>
      </tr>
      <tr>
        <td>KECAMATAN</td>
        <td>'.$find->kecamatan.'</td>
      </tr>
      <tr>
        <td>KELURAHAN</td>
        <td>'.$find->kelurahan.'</td>
      </tr>
      <tr>
        <td>RT/RW</td>
        <td>'.$find->rt.'/'.$find->rw.'</td>
      </tr>
      <tr>
        <td>ALAMAT</td>
        <td>'.$find->alamat.'</td>
      </tr>
      <tr>
        <td>NO. HP</td>
        <td>'.$find->no_hp.'</td>
      </tr>
    </table>';
  }
}
