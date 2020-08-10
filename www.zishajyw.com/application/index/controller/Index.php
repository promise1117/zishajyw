<?php



namespace app\index\controller;



//use think\facade\Hook;

use app\index\controller\Base;

use think\Controller;

use think\facade\Request;

use think\Db;



class Index extends Base

{



    public function __construct()



    {



        parent::__construct();



        $this->banner    = Db('Banner'); //banner表



        $this->category  = Db('Category'); //分类表



        $this->goods     = Db('Goods'); //商品表

        $this->pot_goods     = Db('pot_goods'); //商品表

        $this->pot_category     = Db('pot_category'); //商品表



        $this->comments  = Db('Comments'); //评论表



        $this->goodsinfo = Db('Goodsinfo'); //商品详情表









    }

    public function catAll(){
        //获取一级分类名


        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['show_in_nav','eq','0'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];
        $catList    = Db('pot_category')->where($catWhere)->order($catSort)->select();

        $catAll = array();
        foreach ($catList as $k=>$v){
            if($v['parent_id']==0){

                $catAll[$k] = $v;
                $catAll[$k]['cat_two'] = array();

                foreach ($catList as $kk=>$vv){
                    if($vv['parent_id']==$v['cat_id']){
                        $catAll[$k]['cat_two'][$kk] = $vv;
                        $catAll[$k]['cat_two'][$kk]['cat_three'] = array();
                        foreach ($catList as $kkk=>$vvv){
                            if($vvv['parent_id']==$vv['cat_id']){
                                $catAll[$k]['cat_two'][$kk]['cat_three'][$kkk] = $vvv;
                            }
                        }
                    }
                }
            }
        }

        return $catAll;

    }

    public function index(){





        //热销商品



        $hotwhere[] = ['index','eq','1'];



        $hotwhere[] = ['is_del','eq','0'];
        $hotwhere[] = ['tealeafid','eq','0'];
        $hotwhere[] = ['ambitusid','eq','0'];
        $hotwhere[] = ['iron_kettleid','eq','0'];
        $hotwhere[] = ['silver_kettleid','eq','0'];
        $hotwhere[] = ['chinawareid','eq','0'];



        $hotsort    = ['sort'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



        $hotGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($hotwhere)

            ->order($hotsort)

            ->limit(0,24)

            ->select();











        //新品



        $newwhere[] = ['new','eq','1'];



        $newwhere[] = ['is_del','eq','0'];
        $newwhere[] = ['tealeafid','eq','0'];
        $newwhere[] = ['ambitusid','eq','0'];
        $newwhere[] = ['iron_kettleid','eq','0'];
        $newwhere[] = ['silver_kettleid','eq','0'];
        $newwhere[] = ['chinawareid','eq','0'];



        $newsort = ['sort'=>'desc'];



        $newGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($newwhere)

            ->order($newsort)

            ->limit(0,24)

            ->select();



        $artistlist = Db('pot_artist')

            ->alias('a')

            ->field('a.*,c.cat_name')

            ->join('pot_category c','a.cat_id=c.cat_id','left')

            ->order('c.sort_order','desc')

            ->select();



        $this->assign([


            'hotgoods'  => $hotGoods, //热销商品



            'newgoods'  => $newGoods, //新品商品



            'artistlist' => $artistlist



        ]);







        return $this->fetch();







    }


    public function indexApi($page=""){



        $page == ''?$page = 1:$page = $page;
        $num = 24;
        $start = ($page)*24;


        //新品

//        $newwhere[] = ['new','eq','1'];

        $newwhere[] = ['is_del','eq','0'];
        $newwhere[] = ['tealeafid','eq','0'];
        $newwhere[] = ['ambitusid','eq','0'];
        $newwhere[] = ['iron_kettleid','eq','0'];
        $newwhere[] = ['silver_kettleid','eq','0'];
        $newwhere[] = ['chinawareid','eq','0'];

        $newsort = ['create_time'=>'desc'];


        $newGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($newwhere)

            ->order($newsort)

            ->limit($start,$num)

            ->select();
        $countNewGoods = count(Db('pot_goods')->where($newwhere)->order($newsort)->select());



        return [

            'newgoods'  => $newGoods, //新品商品

            'page' => $page,

            'countNewGoods' => $countNewGoods

        ];



    }



    public function category()

    {



        //banner获取



        $bmap[] = ['is_show','eq','0'];



        $bmap[] = ['show_in_nav','eq','0'];



        $bsort  = ['order'=>'desc','id'=>'desc'];



        $res = $this->banner->where($bmap)->order($bsort)->select();



        //获取一级分类名



//        $catList = $this->getCategoryParentList();

//        dump($this->cat());die;

//        foreach($catList as $k=>$v){
//
//
//
//            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();
//
//
//
//            $catList[$k]['cat_two'] = $cat_two;
//
//
//
//        }



        //获取所有分类



//        $catListt = $this->getCategoryParentListt();



        //获取热卖 分类



//        $catHotList = $this->getCategoryHotList();



        //热销商品



        $hotwhere[] = ['index','eq','1'];

        $hotwhere[] = ['tealeafid','eq','0'];
        $hotwhere[] = ['ambitusid','eq','0'];
        $hotwhere[] = ['iron_kettleid','eq','0'];
        $hotwhere[] = ['silver_kettleid','eq','0'];
        $hotwhere[] = ['chinawareid','eq','0'];



        $hotwhere[] = ['is_del','eq','0'];



        $hotsort    = ['sort'=>'desc','id'=>'desc'];





        //新品



//        $newwhere[] = ['index','eq','1'];



        $newwhere[] = ['is_del','eq','0'];
        $newwhere[] = ['tealeafid','eq','0'];
        $newwhere[] = ['ambitusid','eq','0'];
        $newwhere[] = ['iron_kettleid','eq','0'];
        $newwhere[] = ['silver_kettleid','eq','0'];
        $newwhere[] = ['chinawareid','eq','0'];


        $newsort = ['create_time'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];

        $param = input();

        if(input('type')){

            $subList=  Db('pot_category')->where('parent_id',$param['cat_id'])->select();
            $subId = array();
            foreach ($subList as $v){
                array_push($subId,$v['cat_id']);
            }

            if(!empty($param['is_people'])){

                return $this->redirect('/artist');

            }elseif(!empty($param['is_shape'])){


                $hotwhere[] = ['shapeid','in',$subId];
                $newwhere[] = ['shapeid','in',$subId];

            }elseif(!empty($param['is_mud'])){

                $hotwhere[] = ['mudid','in',$subId];
                $newwhere[] = ['mudid','in',$subId];


            }elseif(!empty($param['is_capacity'])){

                $hotwhere[] = ['capacityid','in',$subId];
                $newwhere[] = ['capacityid','in',$subId];

            }elseif(!empty($param['is_theme'])){

                $hotwhere[] = ['themeid','in',$subId];
                $newwhere[] = ['themeid','in',$subId];

            }elseif(!empty($param['is_tealeaf'])){

                return $this->redirect('/tealeaf');

            }elseif(!empty($param['is_ambitus'])){

                return $this->redirect('/ambitus');

            }elseif(!empty($param['is_chinaware'])){

                return $this->redirect('/chinaware');

            }elseif(!empty($param['is_iron_kettle'])){

                return $this->redirect('/iron_kettle');

            }elseif(!empty($param['is_silver_kettle'])){

                return $this->redirect('/silver_kettle');

            }

        }else{
            if(!empty($param['is_people'])){

                return $this->redirect('/artist_detail?cat_id='.$param['cat_id']);

            }elseif(!empty($param['is_shape'])){

                $hotwhere[] = ['shapeid','eq',$param['cat_id']];
                $newwhere[] = ['shapeid','eq',$param['cat_id']];

            }elseif(!empty($param['is_mud'])){

                $hotwhere[] = ['mudid','eq',$param['cat_id']];
                $newwhere[] = ['mudid','eq',$param['cat_id']];


            }elseif(!empty($param['is_capacity'])){

                $hotwhere[] = ['capacityid','eq',$param['cat_id']];
                $newwhere[] = ['capacityid','eq',$param['cat_id']];

            }elseif(!empty($param['is_theme'])){

                $hotwhere[] = ['themeid','eq',$param['cat_id']];
                $newwhere[] = ['themeid','eq',$param['cat_id']];

            }elseif(!empty($param['is_tealeaf'])){

                return $this->redirect('/tealeaf?cat_id='.$param['cat_id']);

            }elseif(!empty($param['is_ambitus'])){

                return $this->redirect('/ambitus?cat_id='.$param['cat_id']);

            }elseif(!empty($param['is_chinaware'])){

                return $this->redirect('/chinaware?cat_id='.$param['cat_id']);

            }elseif(!empty($param['is_iron_kettle'])){

                return $this->redirect('/iron_kettle?cat_id='.$param['cat_id']);

            }elseif(!empty($param['is_silver_kettle'])){

                return $this->redirect('/silver_kettle?cat_id='.$param['cat_id']);

            }elseif(!empty($param['price'])){
                if($param['price']==1){
                    $hotwhere[] = ['sell_price','>=',0];
                    $hotwhere[] = ['sell_price','<',1000];
                    $newwhere[] = ['sell_price','>=',0];
                    $newwhere[] = ['sell_price','<',1000];
                }elseif($param['price']==2){
                    $hotwhere[] = ['sell_price','>=',1000];
                    $hotwhere[] = ['sell_price','<',4000];
                    $newwhere[] = ['sell_price','>=',1000];
                    $newwhere[] = ['sell_price','<',4000];
                }elseif($param['price']==3){
                    $hotwhere[] = ['sell_price','>=',4000];
                    $hotwhere[] = ['sell_price','<',8000];
                    $newwhere[] = ['sell_price','>=',4000];
                    $newwhere[] = ['sell_price','<',8000];
                }elseif($param['price']==4){
                    $hotwhere[] = ['sell_price','>=',8000];
                    $hotwhere[] = ['sell_price','<',20000];
                    $newwhere[] = ['sell_price','>=',8000];
                    $newwhere[] = ['sell_price','<',20000];
                }elseif($param['price']==5){
                    $hotwhere[] = ['sell_price','>=',20000];
                    $newwhere[] = ['sell_price','>=',20000];
                }

            }
        }


        $hotGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($hotwhere)

            ->order($hotsort)

//            ->limit(0,24)

            ->select();

//        dump($hotGoods);die;


        /**
         * 沉饮放拨插弦中
         * 整顿衣裳起敛容
         */


        $newGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($newwhere)

            ->order($newsort)

//            ->limit(0,24)

            ->select();







        $this->assign([



            'banner'    => $res, //banner


//
//            'catlist'   => $catList, //一级分类
//
//
//
//            'catlistt'  => $catListt, //所有分类



//            'hotlist'   => $catHotList, //获取热卖



            'hotgoods'  => $hotGoods, //热销商品



            'newgoods'  => $newGoods, //新品商品



        ]);

        return $this->fetch();

    }





    public function product()

    {


        //获取header頂部分类名

        $this->catList = $this->catAll();



        $this->assign('catlist',$this->catList);


        $gid = request()->param('goodsid');

        //商品浏览量+1

        $this->pot_goods->where('id',$gid)->setInc('visit');

        //商品内容

        $goodsInfo = $this->pot_goods

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_mudid.keywords as mud_keywords,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

//            ->join('pot_artist artist','g.pid=artist.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where('g.id',$gid)

            ->find();
        $pid = $goodsInfo['pid'];
        $artist = Db('pot_artist')->where('cat_id',$pid)->find();

        $goodsInfo['position'] = $artist['position'];
        $goodsInfo['description'] = $artist['description'];
        $goodsInfo['artist_img'] = $artist['img'];
//        dump($goodsInfo);die;
	        // 关联作品

        $link_goodsInfo = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where('pid',$goodsInfo['pid'])

            ->select();





        $catList = $this->catList;





        $this->assign([

            'catlist'   => $catList, //一级分类

            'info'      => $goodsInfo, //商品详情

            'link_info' => $link_goodsInfo, //作者关联商品

        ]);

        return $this->fetch();

    }



    public function collection()

    {

        //热销商品



        $hotwhere[] = ['index','eq','1'];



        $hotwhere[] = ['is_del','eq','0'];



        $hotsort    = ['sort'=>'desc','id'=>'desc'];

        $hotGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($hotwhere)

            ->order($hotsort)

//            ->limit(0,24)

            ->select();

        $this->assign([

            'hotgoods'  => $hotGoods, //热销商品

        ]);
        return $this->fetch();

    }

    public function collectionApi(){


        $param = input('type')?input('type'):0;

        if($param == 0){

        }elseif($param == '1'){
            $hotwhere[] = ['iron_kettleid','eq','0'];
            $hotwhere[] = ['silver_kettleid','eq','0'];
            $hotwhere[] = ['chinawareid','eq','0'];

            $newwhere[] = ['iron_kettleid','eq','0'];
            $newwhere[] = ['silver_kettleid','eq','0'];
            $newwhere[] = ['chinawareid','eq','0'];
            $newwhere[] = ['new','eq','1'];

            $specialwhere[] = ['iron_kettleid','eq','0'];
            $specialwhere[] = ['silver_kettleid','eq','0'];
            $specialwhere[] = ['chinawareid','eq','0'];
        }elseif($param == '2'){
            $hotwhere[] = ['chinawareid','neq','0'];
            $newwhere[] = ['chinawareid','neq','0'];
            $specialwhere[] = ['chinawareid','neq','0'];
        }elseif($param == '3'){
            $hotwhere[] = ['iron_kettleid','neq','0'];
            $newwhere[] = ['iron_kettleid','neq','0'];
            $specialwhere[] = ['iron_kettleid','neq','0'];
        }elseif($param == '4'){
            $hotwhere[] = ['silver_kettleid','neq','0'];
            $newwhere[] = ['silver_kettleid','neq','0'];
            $specialwhere[] = ['silver_kettleid','neq','0'];
        }
        //热销商品



        $hotwhere[] = ['index','eq','1'];

        $hotwhere[] = ['is_del','eq','0'];

        $hotsort    = ['sort'=>'desc','id'=>'desc'];

        $hotGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($hotwhere)

            ->order($hotsort)

//            ->limit(0,24)

            ->select();



        //新品



//        $newwhere[] = ['new','eq','1'];



        $newwhere[] = ['is_del','eq','0'];



        $newsort = ['create_time'=>'desc'];


        $newGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($newwhere)

            ->order($newsort)

//            ->limit(0,24)

            ->select();




        //已結緣



        $specialwhere[] = ['special','eq','1'];



        $specialwhere[] = ['is_del','eq','0'];



        $specialsort = ['create_time'=>'desc'];


        $specialGoods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where($specialwhere)

            ->order($specialsort)

//            ->limit(0,24)

            ->select();

        $res = [['newest'=>$newGoods],['popularity'=>$hotGoods],['attached'=>$specialGoods]];
        if($res){
           $data['msg'] = '請求成功';
           $data['code'] = 0;
           $data['res'] = $res;
        }else{
            $data['msg'] = '請求失敗';
            $data['code'] = 1;
            $data['res'] = '';
        }
        return $data;
    }



    public function classification()

    {


        //获取header頂部分类名



        $this->catList = $this->catAll();




//        echo 111;die;


        $this->assign('catlist',$this->catList);

        return $this->fetch();

    }

    public function artist()
    {
        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_people','eq','1'];
        $catSort    = ['sort_order'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')
                    ->alias('g')
                    ->field('g.*,a.position as position,a.description as description,a.img as img')
                    ->join('pot_artist a','g.cat_id=a.cat_id')
                    ->where('g.parent_id',$vv['cat_id'])
                    ->where('g.is_show','1')
                    ->order('g.sort_order','desc')
                    ->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }

        $this->assign([
           'cat'=>$cat
        ]);
        return $this->fetch();

    }


    public function artistApi()
    {
        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_people','eq','1'];
        $catSort    = ['sort_order'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')
                    ->alias('g')
                    ->field('g.*,a.position as position,a.description as description,a.img as img')
                    ->join('pot_artist a','g.cat_id=a.cat_id')
                    ->where('g.parent_id',$vv['cat_id'])
                    ->where('g.is_show','1')
                    ->order('g.sort_order','desc')
                    ->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }

        return json($cat);
    }

    public function artistList()

    {

        return $this->fetch();

    }

    public function artistDetail($cat_id='')

    {



        $param = input('cat_id')?input('cat_id'):$cat_id;



        $artistlist = Db('pot_artist')

            ->alias('a')

            ->field('a.*,c.cat_name')

            ->join('pot_category c','a.cat_id=c.cat_id','left')

            ->where('a.cat_id',$param)

            ->order('id','desc')

            ->find();





        $Goods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where('g.pid',$artistlist['cat_id'])

            ->limit(0,24)

            ->select();



        $this->assign([

            'artistlist'=>$artistlist,

            'goods'=>$Goods

        ]);

        return $this->fetch();

    }

    public function artistDetailApi($cat_id='')

    {



        $param = input('cat_id')?input('cat_id'):$cat_id;



        $artistlist = Db('pot_artist')

            ->alias('a')

            ->field('a.*,c.cat_name')

            ->join('pot_category c','a.cat_id=c.cat_id','left')

            ->where('a.cat_id',$param)

            ->order('id','desc')

            ->find();





        $Goods = Db('pot_goods')

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

            ->where('g.pid',$artistlist['cat_id'])

            ->limit(0,24)

            ->select();



        return json([

            'artistlist'=>$artistlist,

            'goods'=>$Goods

        ]);


    }

    public function ambitus()

    {

        $param = input('cat_id')?input('cat_id'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.ambitusid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.ambitusid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.ambitusid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.ambitusid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }



        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_ambitus','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }

//
//        dump($cat);

        $this->assign([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,

            'cat'=>$cat

        ]);

        return $this->fetch();

    }

    public function ambitusApi()

    {

        $param = input('type')?input('type'):'';



        if($param){



            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.ambitusid','eq',$param];

            $hotwhere[] = ['g.index','eq',1];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.ambitusid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.ambitusid','neq',0];

            $hotwhere[] = ['g.index','eq','1'];

            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.ambitusid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }





        return [

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,


        ];


    }



    public function tealeaf()

    {

        $param = input('cat_id')?input('cat_id'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.tealeafid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.tealeafid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.tealeafid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.tealeafid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }

        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_tealeaf','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }


        $this->assign([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,

            'cat'=>$cat

        ]);



        return $this->fetch();

    }

    public function tealeafApi()

    {

        $param = input('type')?input('type'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];



            $hotwhere[] = ['g.tealeafid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.tealeafid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];

            $hotwhere[] = ['g.tealeafid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.tealeafid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }



        return ([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,


        ]);



//        return $this->fetch();

    }


    public function chinaware()
    {
        $param = input('cat_id')?input('cat_id'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.chinawareid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];

//            dump($hotwhere);die;

            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.chinawareid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.chinawareid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.chinawareid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }

        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_chinaware','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }



        $this->assign([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,

            'cat'=>$cat

        ]);

        return $this->fetch();

    }

    public function chinawareApi()

    {

        $param = input('type')?input('type'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];



            $hotwhere[] = ['g.chinawareid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.chinawareid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];

            $hotwhere[] = ['g.chinawareid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.chinawareid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }



        return ([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,


        ]);



//        return $this->fetch();

    }

    public function ironKettle()

    {

        $param = input('cat_id')?input('cat_id'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.iron_kettleid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.iron_kettleid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.iron_kettleid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.iron_kettleid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }

        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_iron_kettle','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }



        $this->assign([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,

            'cat'=>$cat

        ]);

        return $this->fetch();

    }


    public function ironKettleApi()

    {

        $param = input('type')?input('type'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];



            $hotwhere[] = ['g.iron_kettleid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.iron_kettleid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];

            $hotwhere[] = ['g.iron_kettleid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.iron_kettleid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }



        return ([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,


        ]);



//        return $this->fetch();

    }





    public function silverKettle()

    {

        $param = input('cat_id')?input('cat_id'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.silver_kettleid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];

//            dump($hotwhere);die;

            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.silver_kettleid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];



            $hotwhere[] = ['g.silver_kettleid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.silver_kettleid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }

        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_silver_kettle','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $cat   = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWhere)->order($catSort)->select();



        foreach($cat as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $cat[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $cat[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }



        $this->assign([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,

            'cat'=>$cat

        ]);

        return $this->fetch();

    }

    public function silverKettleApi()

    {

        $param = input('type')?input('type'):'';



        if($param){

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];



            $hotwhere[] = ['g.silver_kettleid','eq',$param];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.silver_kettleid','eq',$param];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }else{

            $hotwhere[] = ['g.is_del','eq','0'];

            $hotwhere[] = ['g.index','eq','1'];

            $hotwhere[] = ['g.silver_kettleid','neq',0];



            $hotsort    = ['g.sort'=>'desc','g.id'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];



            $hotGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($hotwhere)



                ->order($hotsort)

                ->limit(0,24)

                ->select();





            //新品



//            $newwhere[] = ['g.index','eq','1'];



            $newwhere[] = ['g.is_del','eq','0'];

            $newwhere[] = ['g.silver_kettleid','neq',0];



            $newsort = ['g.create_time'=>'desc'];



            $newGoods = Db('pot_goods')

                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                ->where($newwhere)

                ->order($newsort)

                ->limit(0,24)

                ->select();

        }



        return ([

            'hotgoods' => $hotGoods,

            'newgoods' => $newGoods,

            'cat_id'=>$param,


        ]);



//        return $this->fetch();

    }



    public function potShape(){

        $catWhere[] = ['parent_id','eq','0'];

        $catWhere[] = ['is_show','eq','1'];

        $catWhere[] = ['is_shape','eq','1'];

        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];

        $catList    = Db('pot_category')->where($catWhere)->order($catSort)->select();

        foreach($catList as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $catList[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $catList[$k]['cat_two'][$kk]['cat_three'] = $cat_three;
                foreach ($cat_three as $kkk=>$vvv){
                    $link_goods = Db::name('pot_goods')
                        ->alias('g')

                        ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                        ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                        ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                        ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                        ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                        ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                        ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                        ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                        ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                        ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                        ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                        ->where('g.shapeid',$vvv['cat_id'])

                        ->where('g.is_del','0')

                        ->order('g.create_time','desc')

                        ->limit('0','2')

                        ->select();
                    $catList[$k]['cat_two'][$kk]['cat_three'][$kkk]['link_goods'] = $link_goods;
                }


            }



        }



        // 推薦壺型 hot字段
        $catWhere[] = ['parent_id','eq','0'];

        $catWhere[] = ['is_show','eq','1'];

        $catWhere[] = ['is_shape','eq','1'];

        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];

        $hotList    = Db('pot_category')->where($catWhere)->order($catSort)->select();

        foreach($hotList as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $hotList[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')
                    ->where('parent_id',$vv['cat_id'])
                    ->where('is_show','1')
                    ->where('hot','1')
                    ->order('sort_order','desc')
                    ->select();
                $hotList[$k]['cat_two'][$kk]['cat_three'] = $cat_three;


            }



        }

        $this->assign([

           'cat'=>$catList,'hotlist'=>$hotList

        ]);

        return $this->fetch();

    }

    public function slurry(){

        $catWhere[] = ['parent_id','eq','0'];

        $catWhere[] = ['is_show','eq','1'];

        $catWhere[] = ['is_mud','eq','1'];

        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];

        $catList    = Db('pot_category')->where($catWhere)->order($catSort)->select();

        foreach($catList as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $catList[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')
                    ->where('parent_id',$vv['cat_id'])
                    ->where('is_show','1')
                    ->order('sort_order','desc')
                    ->select();
                $catList[$k]['cat_two'][$kk]['cat_three'] = $cat_three;

                foreach ($cat_three as $kkk=>$vvv){
                    $link_goods = Db::name('pot_goods')
                        ->alias('g')

                        ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                        ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                        ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                        ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                        ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                        ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                        ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                        ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                        ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                        ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                        ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')

                        ->where('g.mudid',$vvv['cat_id'])

                        ->where('g.is_del','0')

                        ->order('g.create_time','desc')

                        ->limit('0','2')

                        ->select();
                    $catList[$k]['cat_two'][$kk]['cat_three'][$kkk]['link_goods'] = $link_goods;
                }


            }



        }




        // 推薦泥料 hot字段
        $catWhere[] = ['parent_id','eq','0'];

        $catWhere[] = ['is_show','eq','1'];

        $catWhere[] = ['is_mud','eq','1'];

        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];

        $hotList    = Db('pot_category')->where($catWhere)->order($catSort)->select();

        foreach($hotList as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $hotList[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')
                    ->where('parent_id',$vv['cat_id'])
                    ->where('is_show','1')
                    ->where('hot','1')
                    ->order('sort_order','desc')
                    ->select();
                $hotList[$k]['cat_two'][$kk]['cat_three'] = $cat_three;


            }



        }

        $this->assign([

            'cat'=>$catList,
            'hotlist'=>$hotList

        ]);

        return $this->fetch();

    }


    public function search($page="",$param=""){


        $page == ''?$page = 1:$page = $page;

        $num = 20;

        $start = ($page-1)*20;





        $param = input('search')?input('search'):$param;



        $sort    = ['sort'=>'desc','id'=>'desc'];



        $data = Db::name('pot_goods')
            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
            ->where([['g.goods_no','like',$param]])
            ->where('g.is_del','=',0)
            ->order($sort)
            ->limit($start,$num)
            ->select();

        if(empty($data)){
            $data = Db::name('pot_goods')
                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
                ->where([['g.name','like','%'.$param.'%']])
                ->where('g.is_del','=',0)
                ->order($sort)
                ->limit($start,$num)
                ->select();
        }

        if(empty($data)){
            $data = Db::name('pot_goods')
            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
            ->where([['c_pid.cat_name','like','%'.$param.'%']])
            ->where('g.is_del','=',0)
            ->order($sort)
            ->limit($start,$num)
            ->select();
        }




        $artistData = Db::name('pot_category')
            ->alias('g')
            ->field('g.*,a.position as position,a.description as description,a.img as img')
            ->join('pot_artist a','g.cat_id=a.cat_id')
            ->where([['g.is_people','eq','1'],['g.is_show','eq','1'],['g.parent_id','neq','0']])
            ->where('g.cat_name','like','%'.$param.'%')
            ->select();



        $count = count(Db::name('pot_goods')->where('is_del',0)->where('goods_no','like',$param)->whereOr('name','like','%'.$param.'%')->select());








        $page_all = ceil($count/20);


        $this->assign([



            'goods'  => $data, //热销商品

            'page'=>$page,

            'page_all'=>$page_all,

            'search'=>$param,

            'artistData' =>$artistData

        ]);

        return $this->fetch();

    }

    public function searchApi($page="",$param=""){


        $page == ''?$page = 1:$page = $page;

        $num = 20;

        $start = ($page-1)*20;





        $param = input('search')?input('search'):$param;



        $sort    = ['sort'=>'desc','id'=>'desc'];



        $data = Db::name('pot_goods')
            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

            ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

            ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

            ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

            ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

            ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

            ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

            ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

            ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

            ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

            ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
            ->where([['g.goods_no','like',$param]])
            ->where('g.is_del','=',0)
            ->order($sort)
            ->limit($start,$num)
            ->select();

        if(empty($data)){
            $data = Db::name('pot_goods')
                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
                ->where([['g.name','like','%'.$param.'%']])
                ->where('g.is_del','=',0)
                ->order($sort)
                ->limit($start,$num)
                ->select();
        }

        if(empty($data)){
            $data = Db::name('pot_goods')
                ->alias('g')

                ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

                ->join('pot_category c_pid','g.pid=c_pid.cat_id','left')

                ->join('pot_category c_shapeid','g.shapeid=c_shapeid.cat_id','left')

                ->join('pot_category c_capacityid','g.capacityid=c_capacityid.cat_id','left')

                ->join('pot_category c_themeid','g.themeid=c_themeid.cat_id','left')

                ->join('pot_category c_mudid','g.mudid=c_mudid.cat_id','left')

                ->join('pot_category c_tealeafid','g.tealeafid=c_tealeafid.cat_id','left')

                ->join('pot_category c_ambitusid','g.ambitusid=c_ambitusid.cat_id','left')

                ->join('pot_category c_chinawareid','g.chinawareid=c_chinawareid.cat_id','left')

                ->join('pot_category c_iron_kettleid','g.iron_kettleid=c_iron_kettleid.cat_id','left')

                ->join('pot_category c_silver_kettleid','g.silver_kettleid=c_silver_kettleid.cat_id','left')
                ->where([['c_pid.cat_name','like','%'.$param.'%']])
                ->where('g.is_del','=',0)
                ->order($sort)
                ->limit($start,$num)
                ->select();
        }




        $artistData = Db::name('pot_category')
            ->alias('g')
            ->field('g.*,a.position as position,a.description as description,a.img as img')
            ->join('pot_artist a','g.cat_id=a.cat_id')
            ->where([['g.is_people','eq','1'],['g.is_show','eq','1'],['g.parent_id','neq','0']])
            ->where('g.cat_name','like','%'.$param.'%')
            ->select();



        $count = count(Db::name('pot_goods')->where('is_del',0)->where('goods_no','like',$param)->whereOr('name','like','%'.$param.'%')->select());








        $page_all = ceil($count/20);


        return json([



            'goods'  => $data, //热销商品

            'page'=>$page,

            'page_all'=>$page_all,

            'search'=>$param,

            'artistData' =>$artistData

        ]);


    }

	public function about_us(){
		return $this->fetch();
	}
	
	public function teaPot(){
		return $this->fetch();
	}

	public function poetry(){
        print('
            浔阳江头夜送客,枫叶荻花秋瑟瑟
            主人下马客在船,举酒欲饮无管弦
            醉不成欢惨将别,别时茫茫江浸月
            忽闻水上琵琶声,主人忘归客不发
            寻声暗问弹者谁,琵琶声停欲语迟
            移船相近邀相见,添酒回灯重开宴
            千呼万唤始出来,犹抱琵琶半遮面
            转轴拨弦三两声,未成曲调先有情
            弦弦掩抑声声思,似诉平生不得志
            低眉信手续续弹,说尽心中无限事
            轻拢慢捻抹复挑,初为霓裳后六幺
            大弦嘈嘈如急雨,小弦切切如私语
            嘈嘈切切错杂弹,大珠小珠落玉盘
            间关莺语花底滑,幽咽泉流冰下难
            冰泉冷涩弦凝绝,凝绝不通声暂歇
            别有幽愁暗恨生,此时无声胜有声
            银瓶乍破水浆迸,铁骑突出刀枪鸣
            曲终收拨当心画,四弦一声如裂帛
            东船西舫悄无言,唯见江心秋月白
        ');
    }
}

