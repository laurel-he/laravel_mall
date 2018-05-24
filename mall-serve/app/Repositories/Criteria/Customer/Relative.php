<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Relative extends Criteria
{
		
		
		public function __construct(Request $request)
		{
			$this->request = $request;
		}
		
		public function apply($model, RepositoryInterface $repository)
		{
			//laravel文档上whereHas是对hasMany这种关系用的， 没想到这里对hasOne也是可以的。哈哈哈！！！
			$request = $this->request;
			return $model->whereHas('midRelative', function($query) use($request) {
			    $relatives = ['user_id','group_id','department_id'];
			    $where = [];
	        	foreach ($relatives as $value) {
	        	    if ($request->has($value)) {
	        	        $where[]=[$value, $request->input($value)];
	        	        break;
	        		}
	        	}
	        	$query->where($where);
	        	
	        	if ($request->has('user_business')) {
	        	    switch ($request->input('user_business')) {
	        	        case 'tracked':
	        	            $query->whereNotNull('last_track');
	        	            break;
	        	        case 'untracked':
	        	            $query->whereNull('last_track');
	        	            break;
	        	        case 'plan':
	        	            $query->whereDate('plan', (new Carbon)->toDateString());
	        	            break;
	        	        case 'conflict':
	        	            $query->whereNotNull('last_conflict');
	        	            break;
	        	        default:
	        	            break;
	        	    }
	        	}
	        	
	        	if ($request->has('source')) {
	        	    switch ($request->input('source')) {
	        	        case 'out':
	        	            $query->onlyTrashed();	        	            
	        	        case 'in':
	        	            $query->whereIn('type',[1,2]);
	        	            break;
	        	        default:
	        	            break;
	        	    }
	        	}
			});
		}
}