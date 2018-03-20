<?php

namespace App\Repositories\Criteria\ExpressInfo;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Search extends Criteria{

	private $search = null;

	public function __construct($search){

		$this->search = $search;

	}

  public function  apply($model, RepositoryInterface $repository) 
  {
      if (is_array($this->search)) {
          return $model->where($this->search);
      }
      return $model->where($this->search);
  }








}