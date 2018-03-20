<?php
namespace App\Services\Customer;

use Illuminate\Http\Request;
use App\Models\CustomerBasic;
use App\Models\CustomerContact;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerApp;

class AddService 
{
    private $request = null;
    
    public function  __construct(Request $request) 
    {
        $this->request = $request;
    }
    
    public function  get() 
    {
        $post = $this->request->all();
        
        $re = DB::transaction(function() use($post) {
            
            $basicModel = CustomerBasic::make($post);
            $basicModel->save();
            $post['cus_id'] = $basicModel->id;
            
            $appModel = CustomerApp::create($post);
            $contactModel = CustomerContact::create($post);
            
            return $basicModel;
        });
        return $re; 
    }
}