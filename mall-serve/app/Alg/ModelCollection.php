<?php
namespace App\Alg;

use Illuminate\Database\Eloquent\Collection;

class ModelCollection {
    
    /**
     * 给Model添加不存在数据表里的字段
     * @param unknown $collection
     * @param unknown $attributes
     * @return Collection
     */
    public static function  setAppends(Collection  $collection, array $attributes)
    {
        foreach ($collection as $model) {
            $model->setAppends($attributes);
        }
        return $collection;
    }
    
    /**
     * 添加隐藏字段
     * @param unknown $collection
     * @param unknown $attributes
     * @return Collection
     */
    public static function setVisible(Collection $collection, array $attributes)
    {
//     	foreach ($collection as $model) {
//     		dd($model);//这里是模型
//     	}
//     	array_walk($collection, function($model, $key, $attr){
//     		dd($model);// 这里 相当于 $collection->all()的结果
//     		$model->makeVisible($attr);
//     	}, $attributes);
//     	return $collection;

    	return $collection->each(function($model) use($attributes) {
    		$model->makeVisible($attributes);
    	});
    }
}