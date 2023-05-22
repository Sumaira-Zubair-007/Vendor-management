<?php 
namespace App\Controllers;
use App\Models\VendorProposalModal;
use App\Models\VendorModel;
use CodeIgniter\Controller;

class VendorPrposalCrud extends Controller
{
    // show users list
    public function index(){
       
        $proposalModel = new  VendorProposalModal();
        $userModel = new VendorModel();
        $data['proposal'] = $proposalModel->orderBy('id', 'DESC')->findAll();
        foreach($data['proposal']  as $key => $value) {
           
            $id = $data['proposal'][$key]['id'];
            $Vendor_name = $userModel->where('id', $id)->first();
            $data['proposal'][$key]['id'] = $Vendor_name['name'];
          }
      
        return view('proposal_view', $data);
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

       // show users list
       public function benchmark(){
       
        $proposalModel = new  VendorProposalModal();
        $userModel = new VendorModel();
        $data['proposal'] = $proposalModel->orderBy('id', 'DESC')->findAll();
        $total_time = 0;
        $total_cost = 0;
        $total_quality = 0;
       
        $count = count($data['proposal'] );
      
        foreach($data['proposal']  as $key => $value) {
           
            $id = $data['proposal'][$key]['id'];
            $Vendor_name = $userModel->where('id', $id)->first();
            $data['proposal'][$key]['id'] = $Vendor_name['name'];
            $total_time +=  (int) $data['proposal'][$key]['time'];
            $total_cost +=  (int) $data['proposal'][$key]['cost'];
            $total_quality +=  (int) $data['proposal'][$key]['quality'];

          }
          $avg_time = $total_time / $count;
          $avg_cost = $total_cost / $count;
          $avg_quality = $total_quality / $count;
         $data['benchmark'] = ['time' => $avg_time , 'cost' => $avg_cost , 'quality' => $avg_quality];

        //  echo "<pre>";
        //  print_r( $data['benchmark'] );
        //  exit;
        
        

    
         
      
        return view('benchmark', $data);
    }

}