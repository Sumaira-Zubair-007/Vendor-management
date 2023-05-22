<?php 
namespace App\Models;
use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table = 'Vendors';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'email'];
}