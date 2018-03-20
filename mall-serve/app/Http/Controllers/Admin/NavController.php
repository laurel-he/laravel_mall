<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Object_;
use Illuminate\Support\Facades\Log;

class NavController extends Controller
{
	
	public function getNav()
	{
		$user  =   Auth::user();
		$roles = $user->roles;
		
		
		
// 		$user = User::find(1);
// 		$roles = $user->roles;
		
		return $this->getMenus(array_column($roles->toArray(),'name'));
	}
	
	private function getRoleMenus($roles)
	{
		$menu_roles = config('menurole');
		$sub_menus_index = [];
		foreach ($roles as $role) {
			if (isset($menu_roles[$role])) {
				$sub_menus_index = array_merge($sub_menus_index, $menu_roles[$role]);
			}
		}
		return $sub_menus_index;
	}
	
	private function setGMenus($sub_menus_index)
	{
		
		$menu_g = config('menug');
		
		if (in_array('*', $sub_menus_index, TRUE )) {
			return array_map(function($item){
				$item['subNavIndex'] = $item['subIndex'];
				unset($item['subIndex']);
				return $item;
			}, $menu_g);
		}
		
		$re = [];
		foreach ($menu_g as $item) {
			$item['subNavIndex'] = array_intersect($item['subIndex'], $sub_menus_index);
			unset($item['subIndex']);
			if (!empty($item['subNavIndex'])) {
				$re[] = $item;
			}
			
		}
		return $re;
	}
	
	private function setGsMenus($gMenus)
	{
		$smenus = config('menugs');
		foreach ($gMenus as &$value) {
			$value['subNav'] = array_map(function($item)use($smenus){
				return isset($smenus[$item]) ? $smenus[$item] : new Object();
			}, $value['subNavIndex']);
			unset($value['subNavIndex']);
		}
		return  $gMenus;
	}
	
	private function getMenus($roles)
	{
		$roleMenus = $this->getRoleMenus($roles);
		$gMenus  = $this->setGMenus($roleMenus );
		$menus   = $this->setGsMenus($gMenus);
		return $menus;
	}
}
