<?php
namespace App\Repositories\Criteria\Goods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Number extends Criteria
{
		/**
		 *  @var string
		 */
		private $number= null;
		
		public function  __construct($number)
		{
			$this->number= $number;
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

			return $model->where('goods_number','like', $this->number."%");
			
		}





}