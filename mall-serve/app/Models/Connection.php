<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Connection extends Model
{
	    use SoftDeletes;
	    
		protected $table = 'connection_basic';

		protected $fillable = [
				'name',
				'phone',
				'content',
		];




}
