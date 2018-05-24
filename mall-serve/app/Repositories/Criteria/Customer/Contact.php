<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;

class Contact extends Criteria
{
    
    private $request= null;
    
    public function __construct(Request $request)
    {
        
        $this->request = $request;
    }
    
    
    public function  apply($model, RepositoryInterface $repository)
    {
        $request = $this->request;
        return $model->whereHas('contacts', function($query) use($request){
            if ($request->has('phone')) {
                $query->where('phone', 'like',$request->input('phone').'%');
            }
            if ($request->has('qq')) {
                $query->where('qq', 'like',$request->input('qq').'%');
            }
            if ($request->has('weixin')) {
                $query->where('weixin', 'like',$request->input('weixin').'%');
            }
        });
    }
    
}