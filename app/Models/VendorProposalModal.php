<?php 
namespace App\Models;
use CodeIgniter\Model;

class VendorProposalModal extends Model
{
    protected $table = 'proposals';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['vendor_id','proposal_name', 'time', 'cost', 'quality' , 'description'];

}