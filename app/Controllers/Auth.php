<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    function login() {
        return view('login');
    }

    function ajaxLogin() {
        if (! $this->validate([
            'username' => "required",
            'password' => "required"
          ])) {
            return $this->response->setJSON(['status'=>'error','msg'=>'Isi Username dan Password']);
          }

        $model = new UserModel;
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $cek = $model->where(['username'=>$username,'password'=>$password])->first();

        if($cek){
            $ses_data = [
                'id'            => $cek->id,
                'nama'          => $cek->nama,
                'isLoggedIn'    => true,
            ];
            session()->set($ses_data);
            return $this->response->setJSON(['status'=>'success']);
        }else{
            return $this->response->setJSON(['status'=>'error','msg'=>'Username dan Password tidak sesuai']);
        }
    }
}
