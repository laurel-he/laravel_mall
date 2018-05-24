<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProduceEntryProduct;

class EntryProductController extends Controller
{
    public function index(Request $request)
    {
        
        $query = new ProduceEntryProduct();
    
        if ($request->has('entrepot_id')) {
            $entrepot_id = $request->input('entrepot_id');
            $range= [];
            if ($request->has('start') && $request->has('end')) {
               
               $range[] = $request->input('start');
               $range[] = $request->input('end');
            } 
            
            $query = $query->whereHas('produceEntry', function($query) use($entrepot_id,$range) {
                $query->where('entrepot_id', $entrepot_id); 
                if (!empty($range)) {
                    $query->where([
                        ['entry_at', '>=', $range[0]],
                        ['entry_at', '<=', $range[1]],
                    ]);
                }
                
            });
        }
        
        if ($request->has('sku_sn')) {
            $query->where('sku_sn', $request->input('sku_sn'));
        }
        
        
        
        $result = $query->paginate($request->input('pageSize', 20));
        
        $collection = $result->getCollection();
        $collection->load('produceEntry');
        
        
        
        return [
            'items' => $collection->toArray(),
            'total' => $result->total()
        ];
    }
}
