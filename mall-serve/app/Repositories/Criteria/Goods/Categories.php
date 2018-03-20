<?php
namespace App\Repositories\Criteria\Goods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Categories extends Criteria
{
	/**
	 *  @var string
	 */
	private $cate= null;
	
	public function  __construct(array $cate)
	{
		$this->cate = $cate;
	}
	
	/**
	 *
	 * @param unknown $model
	 * @param Repository $repository
	 *
	 * @return mixed
	 */
	public function  apply($model, Repository $repository)
	{
// 		return $model->category()->WherePivotIn('cate_id', $this->cate); //会添加 goods_id is null 
		$cates = $this->cate;
		return $model->whereHas('midCate', function ($query) use($cates) {
					$query->whereIn('cate_id', $cates);
			   });
	}
}