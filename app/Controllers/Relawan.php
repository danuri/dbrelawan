<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\RelawanModel;
use App\Models\WilayahModel;

class Relawan extends BaseController
{
    public function index()
    {
        $wmodel = new WilayahModel;
        $data['kecamatan'] = $wmodel->findAll();
        return view('relawan/index', $data);
    }

    public function getdata()
    {
      $model = new RelawanModel();

      return DataTable::of($model)
      ->add('action', function($row){
          return '<a href="'.site_url('relawan/detail/'.encrypt($row->id)).'" type="button" target="_blank" class="btn btn-sm btn-primary">Detail</a>';
      })->toJson(true);
    }

    public function add()
    {
        if (! $this->validate([
            'nik' => "required|is_unique[relawan.nik]",
            'nkk' => "required",
            'nama' => "required",
          ])) {
            return redirect()->back()->with('message', 'Data gagal ditambahkan');
          }

        $model = new RelawanModel();
        $param = [
            'nik'           => $this->request->getVar('nik'),
            'nkk'           => $this->request->getVar('nkk'),
            'nama'          => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'no_hp'         => $this->request->getVar('no_hp'),
            'id_wilayah'    => $this->request->getVar('wilayah'),
            'jenis'         => $this->request->getVar('jenis'),
            'kecamatan'         => $this->request->getVar('kecamatan'),
            'kelurahan'         => $this->request->getVar('kelurahan'),
            'alamat'         => $this->request->getVar('alamat'),
            'rw'         => $this->request->getVar('rw'),
            'rt'         => $this->request->getVar('rt'),
            'tps_id'         => $this->request->getVar('tps_id'),
            'tps'         => $this->request->getVar('tps'),
            'created_by'    => session('id'),
        ];

        $insert = $model->insert($param);

        // return $this->response->setJSON(['status'=>'success','message'=>'Data berhasil ditambahkan']);
        return redirect()->back()->with('message', 'Data telah ditambahkan');
    }

    public function update()
    {
        $model = new RelawanModel();
        $param = [
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'no_hp'         => $this->request->getVar('no_hp'),
            'alamat'         => $this->request->getVar('alamat'),
            'rw'         => $this->request->getVar('rw'),
            'rt'         => $this->request->getVar('rt'),
        ];

        $insert = $model->update($this->request->getVar('idrelawan'),$param);

        return redirect()->back()->with('message', 'Data telah diupdate');
    }

    public function delete($id)
    {
      $model = new RelawanModel();
      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Data telah dihapus');
    }

    public function wilayah()
    {
        // isinya kecamatan
        $model = new RelawanModel;
        $wm = new WilayahModel;
        $data['jtarget'] = $wm->find('17.71');
        $data['jinput'] = $model->rekapInput('17.71');
        $data['kecamatan'] = $model->rekapWilayah('17.71');
        return view('relawan/kecamatan', $data);
    }

    public function kecamatan($id)
    {
        // isinya kelurahan
        $model = new RelawanModel;
        $data['kelurahan'] = $model->rekapWilayah($id);
        return view('relawan/kelurahan', $data);
    }

    public function kelurahan($id)
    {
        // isinya RT
        $model = new RelawanModel;
        $data['idkel'] = substr($id,0,8);
        $data['kelurahan'] = $model->rekapWilayah($id);
        return view('relawan/rt', $data);
    }

    public function rt($id)
    {
        // isinya RT
        $model = new RelawanModel;
        $data['idrt'] = substr($id,0,13);
        $data['idwilayah'] = $id;
        $data['relawan'] = $model->where(['jenis'=>'relawan','id_wilayah'=>$id])->findAll();
        return view('relawan/relawan', $data);
    }
}
