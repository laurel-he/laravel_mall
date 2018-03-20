<?php
/**
 * 
 * @var cate_type_id
 * @var cate_kind_id
 * @var product_sale_type
 * @var sku_sn
 * @var cate_type
 * @var cate_kind
 * 
 * 
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrepotProductCategory extends Model
{
    protected $table = 'entrepot_product_category';
    
    protected $fillable = [
        'cate_type_id',
        'cate_kind_id',
        'product_sale_type',
        'sku_sn',
        'cate_type',
        'cate_kind'
    ];
}
