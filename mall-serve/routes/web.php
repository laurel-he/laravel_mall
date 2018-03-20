<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function(){
	
	Route::get('/', 'IndexController@index');
	//登录 退出
	Route::post('/login', 'LoginController@login');
	Route::post('/logout', 'LoginController@out');
	Route::resource('/deposits', 'DepositController');
	
	Route::get('/categorys/{lel}','CategoryController@getLevels');
	Route::get('/getCategorys/{pid}','CategoryController@getChildrens');
	Route::resource('/categorys','CategoryController');
	Route::get('/tree','CategoryController@getCascade');
	Route::get('/deleteCategory/{id}','CategoryController@haveChildren');
	Route::resource('/customers','CustomerController');
	Route::match(['put','patch','post'], '/customers-transfer', 'CustomerController@transfer');
	Route::match(['put','patch','post'], '/customers-quit-transfer', 'CustomerController@quitTransfer');
	Route::get('/getUsersByGid/{gid}','EmployeeController@getUserByGId');
	Route::get('/getGroupsByPid/{pid}','GroupController@getGroupsByPid');
	Route::get('/getDepartmentByType/{type}','DepartmentController@getDepartmentByType');

	
	Route::resource('/orderlist','OrderListController');
	Route::resource('/buyorders','BuyOrderController');
// 	Route::resource('/users','EmployeeController');
	Route::resource('/employees','EmployeeController');
	Route::match(['put','patch'], '/employeesupdate', 'EmployeeController@updates');
	//passowrd/2 put patch
	Route::match(['put','patch'], '/passowrd/{id}', 'EmployeeController@changePassword');
	
	
	Route::resource('/buyers','CustomerController');
	Route::resource('/inventorylist','InventoryListController');
	Route::resource('/departments','DepartmentController');
	Route::resource('/groups','GroupController');
	
	Route::resource('/expressinfo','ExpressInfoController');
	Route::post('/upload', 'UploadController@index')->name('upload');
	Route::resource('/roles','RoleController');
	Route::get('/roles-assignable','RoleController@assignable');
	
	
	Route::resource('/goodsdetails','GoodsDetailsController');
	Route::resource('/customerinformation','CustomerInformationController');
	Route::resource('/departments','DepartmentController');
	// Route::resource('/orderlists','OrderListController');
	Route::resource('/ordergoods','OrderGoodsController');
	
	Route::resource('/goodsout','GoodsOutController');
	Route::resource('/goodsinto','GoodsIntoController');
	Route::resource('/goodsspecs','GoodsSpecsController');
	Route::resource('/goodstype','GoodsTypeController');
	Route::resource('/goodssku', 'GoodsSkuController');
	Route::get('/goodstypelist','GoodsTypeController@goodsTypeList');
	Route::resource('/deliveryaddress','DeliveryAddressController');
	Route::resource('/orderbasic','OrderBasicController');
	
	Route::resource('/articles' , 'ArticleController');
	Route::resource('/connection' , 'ConnectionController');
	Route::resource('/skincareinfo','SkinCateInfoController');
	Route::resource('/sysnotice','SysNoticeController');
	Route::resource('/contacts','ContactsController');
	Route::resource('/website','WebsiteController');
	Route::resource('/distributioncenter','DistributionCenterController');
	Route::resource('/shelvesmanagement','ShelvesManagementController');
	Route::resource('/expresscompany','ExpressCompanyController');
	Route::get('/menus', 'NavController@getNav');
	
	Route::resource('/produce-entry', 'ProduceEntryController');
	Route::get('/getsalelockdata', 'ProduceEntryController@GetSaleLockData');
	Route::get('/entrepot-product-count/{sku_sn}', 'EntrepotProductController@getEntrepotProductCount');

});


	
// Route::get('/', function () {
// 	// return view('welcome');
// 	return view('test/test');
// });

Route::get('/', 'Home\IndexController@index');


Route::get('/product/index', 'Home\ProductController@index')->name('product/index');
Route::get('/product/product', 'Home\ProductController@product')->name('product/product');
Route::get('/login/index', 'Home\LoginController@index')->name('login/index');
Route::get('/login/loginOut', 'Home\LoginController@loginOut')->name('login/loginOut');
Route::get('/login/register', 'Home\LoginController@register')->name('login/register');
Route::get('/information/index', 'Home\InformationController@index')->name('information/index');
Route::get('/information/news', 'Home\InformationController@news')->name('information/news');
Route::get('/connection/index', 'Home\ConnectionController@index')->name('connection/index');
Route::get('/car/index', 'Home\CarController@index')->name('car/index');
Route::post('/login/loginIn','Home\LoginController@loginIn')->name('login/loginIn');
Route::get('/person/index', 'Home\PersonController@index')->name('person/index');
Route::get('/person/address', 'Home\PersonController@address')->name('person/address');
Route::get('/person/collection', 'Home\PersonController@collection')->name('person/collection');
Route::get('/person/orderDetails', 'Home\PersonController@orderDetails')->name('person/orderDetails');
Route::get('/person/orderManage', 'Home\PersonController@orderManage')->name('person/orderManage');
Route::get('/person/password', 'Home\PersonController@password')->name('person/password');
Route::post('/person/password_do', 'Home\PersonController@password_do')->name('person/password_do');
Route::post('/person/personChange', 'Home\PersonController@personChange')->name('person/personChange');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
// 	Route::get('/','AdminHomeController@index');
// 	Route::resource('pages','PagesController');
// });
Route::resource('photo','PhotoController');
		
// Route::get('/', function () {
// 	// return view('welcome');
// 	return view('test/test');
// });
