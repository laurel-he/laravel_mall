<?php
namespace  App\Services\Category;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Storage\Handler;
use App\Repositories\Criteria\FieldEqual;
class CategoryService
{
    private $repository = null;
    
    private $request = null;
    
    public function  __construct(CategoryRepository $categoryRepositiry, Request $request)
    {
        $this->repository = $categoryRepositiry;
        $this->request = $request;
    }

    public function get_child($arr,$pid=0){
        $child=array();
        foreach ($arr as $v) {
            if($v->pid==$pid){
                $child[]=$v;
            }
        }
        return $child;
    }

    public function cate_list($arr,$pid=0){
        $child=$this->get_child($arr,$pid);
        if (empty($child)) {
            return null;
        }
        foreach ($child as $k => $v) {
            $second_child=$this->cate_list($arr,$v->id);
            if (!empty($second_child)) {
                $child[$k]->children=$second_child;
            }
        }
        return $child;
    }
    public function  get() 
    {
        $data = $this->repository->all();
        $result = $this->cate_list($data);
        return [
            'items'=>$result,
        ];
    }
}