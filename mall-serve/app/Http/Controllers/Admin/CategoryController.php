<?php

namespace App\Http\Controllers\Admin;

use App\models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	private $repository = null;
	public function __construct(CategoryRepository $categoryRepository) {
		$this->repository = $categoryRepository;
	}


	public function index() {
		$service = app ( 'App\Services\Category\CategoryService' );
		$result = $service->get ();
		return $result;
	}

	/**
	 * 获得全部二级
	 * @param  Category $category [description]
	 * @param  [type]   $pid      [description]
	 * @return [type]             [description]
	 */
	public function getLevels(Category $category, $pid) {
		$data = $category->where ( 'level', '=', $pid )->get ();
		return $data;
	}

  /**
   * 或者特定的二级
   * @param  Category $category [description]
   * @param  [type]   $pid      [description]
   * @return [type]             [description]
   */
	public function getChildrens(Category $category, $pid) {
		$data = $category->where ( 'pid', '=', $pid )->get ();
		return $data;
	}

	// 通过商品类型id判断是否有子级
	public function haveChildren(Category $category, $id) {
		$data = count ( $category->where ( 'pid', '=', $id )->get () ) ? 1 : 0;
		return [ 
				'items' => $data 
		];
	}


	// 返回商品类别选择的级联数据
	public function getCascade() {
		$arr = $this->index () ['items'];
		return [ 
				'items' => $this->getTree ( $arr ) 
		];
	}


	public function getTree($array) {
		$child = [ ];
		foreach ( $array as $k => $v ) {
			$child [$k] ['value'] = $v->id;
			$child [$k] ['id'] = $v->id;
			$child [$k] ['type_id'] = $v->type_id;
			$child [$k] ['pid'] = $v->pid;
			$child [$k] ['label'] = $v->label;
			$child [$k] ['level'] = $v->level;
			if (! empty ( $v->children )) {
				$child [$k] ['children'] = $this->getTree ( $v->children );
			}
		}
		return $child;
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->all ();
		// DD($data);
		$re = $this->repository->create ( $data );
		if ($re) {
			return $this->success ( $re );
		} else {
			return $this->error ( 0 );
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param \App\models\Category $category        	
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category) {
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\models\Category $category        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \App\models\Category $category        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$re = Category::where ( 'id', '=', $id )->update ( $request->input () );
		if ($re) {
			return $this->success ( 1 );
		} else {
			return $this->error ( 0 );
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\models\Category $category        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
		$re = $this->repository->delete ( $id );
		if ($re) {
			return $this->success ( 1 );
			;
        } else {
            return $this->error(0);
        }
    }
}
