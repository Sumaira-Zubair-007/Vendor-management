<?php 
namespace App\Controllers;
use App\Models\VendorModel;
use CodeIgniter\Controller;

class VendorCrud extends Controller
{
    // show users list
    public function index(){
        $userModel = new VendorModel();
        $data['users'] = $userModel->orderBy('id', 'ASC')->findAll();
        return view('vendor_view', $data);
    }

    // show add user form
    public function create(){
        return view('add_vendor');
    }
 
    // insert data into database
    public function store() {
        $userModel = new VendorModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->insert($data);
        return $this->response->redirect(base_url('/public/vendors-list'));
    }

    // show single user
    public function singleUser($id = null){
        $userModel = new VendorModel();
        $data['user_obj'] = $userModel->where('id', $id)->first();
        return view('edit_user', $data);
    }

    // update user data
    public function update(){
        $userModel = new VendorModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/vendors-list'));
    }
 
    // delete user
    public function delete($id = null){
        $userModel = new VendorModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/vendors-list'));
    }    
}