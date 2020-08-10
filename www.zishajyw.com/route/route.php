<?php
//use think\facade\Route;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');


Route::any('mid','index/index/mid')->middleware('Check');

// 紫砂壶手机端路由
Route::any('index','index/Index/index');
Route::any('indexApi','index/Index/indexApi');
Route::any('category/[:cate]/[:id]/[:type]','index/Index/category');
Route::any('goodsinfo','index/Index/product');
Route::any('collection','index/Index/collection');
Route::any('collectionApi','index/Index/collectionApi');
Route::any('classification','index/Index/classification');
Route::any('artist','index/Index/artist');
Route::any('artistApi','index/Index/artistApi');
Route::any('artist_list','index/Index/artistList');
Route::any('artist_detail','index/Index/artistDetail');
Route::any('artist_detailApi','index/Index/artistDetailApi');
Route::any('tealeaf','index/Index/tealeaf');
Route::any('tealeafApi','index/Index/tealeafApi');
Route::any('iron_kettle','index/Index/ironKettle');
Route::any('iron_kettleApi','index/Index/ironKettleApi');
Route::any('silver_kettle','index/Index/silverKettle');
Route::any('silver_kettleApi','index/Index/silverKettleApi');
// 周邊
Route::any('ambitus','index/Index/ambitus');
Route::any('ambitusApi','index/Index/ambitusApi');
Route::any('chinaware','index/Index/chinaware');
Route::any('chinawareApi','index/Index/chinawareApi');
// 首页壶型
Route::any('pot_shape','index/Index/potShape');
Route::any('slurry','index/Index/slurry');

Route::any('search','index/Index/search');
Route::any('searchApi','index/Index/searchApi');
Route::any('about_us','index/Index/about_us');

// 紫砂壶

Route::rule('pot','index/Pot/index');
Route::rule('pot_add','index/Pot/add');
Route::rule('game_add','index/Pot/gameAdd');
Route::rule('clay_pot','index/Pot/yixinClayPot');
Route::rule('tea_pot','index/Index/teaPot');
Route::rule('ceshi','index/Index/ceshi');




//-------------------------------------------------------------------//


// 紫砂壶pc端路由
Route::any('pc_index','pc/Index/index');
/**
 * 分类路由用作xhr请求
 */
Route::any('catAll','pc/Index/catAll');

Route::any('pc_indexApi','pc/Index/indexApi');
Route::any('pc_category/[:cate]/[:id]/[:type]','pc/Index/category');
Route::any('pc_selectApi','pc/Index/selectApi');
Route::any('pc_goodsinfo','pc/Index/product');
Route::any('pc_collection','pc/Index/collection');
Route::any('pc_collectionApi','pc/Index/collectionApi');
Route::any('pc_classification','pc/Index/classification');
Route::any('pc_artist','pc/Index/artist');
Route::any('pc_artist_list','pc/Index/artistList');
Route::any('pc_artist_detail','pc/Index/artistDetail');
Route::any('pc_tealeaf','pc/Index/tealeaf');
Route::any('pc_tealeafApi','pc/Index/tealeafApi');
Route::any('pc_iron_kettle','pc/Index/ironKettle');
Route::any('pc_iron_kettleApi','pc/Index/ironKettleApi');
Route::any('pc_silver_kettle','pc/Index/silverKettle');
Route::any('pc_silver_kettleApi','pc/Index/silverKettleApi');
Route::any('pc_search','pc/Index/search');
Route::any('pc_tealeaves','pc/Index/tealeaves');


return [

];
