<?php

namespace App\Controllers;
use App\Models\RelawanModel;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new RelawanModel;
        $data['total'] = $model->countAll();
        $data['gkecamatan'] = $model->rekapWilayah('17.71');
        $data['jkorcam'] = $model->rekapInputJenis('korcam');
        $data['jkorkel'] = $model->rekapInputJenis('korkel');
        $data['jkorrt'] = $model->rekapInputJenis('korrt');
        $data['jrelawan'] = $model->rekapInputJenis('relawan');
        return view('home', $data);
    }
}
