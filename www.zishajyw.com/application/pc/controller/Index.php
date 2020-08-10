<?php
namespace app\pc\controller;



//use think\facade\Hook;

use app\pc\controller\Base;

use think\Controller;

use think\facade\Request;

use think\Db;



class Index extends Base
{

    public function __construct()
    {

        parent::__construct();


        $this->pot_goods     = Db('pot_goods'); //商品表

        $this->pot_category     = Db('pot_category'); //商品表


    }

    public function catAll($sub=""){
        //获取一级分类名

        if($sub == 'is_people'){
            $catWhere[] = ['is_people','eq','1'];
        }
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


        $catAll = $this->catAll();



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

            ->limit(0,10)

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

            ->limit(0,10)

            ->select();
        


        $artistlist = Db('pot_artist')

            ->alias('a')

            ->field('a.*,c.cat_name')

            ->join('pot_category c','a.cat_id=c.cat_id','left')
            // 定期更换首页展示艺术员
            ->where('c.cat_id','in',['576','582','634','637'])

            ->where('c.is_show','eq',1)

            ->order('id','desc')

            ->select();


        $this->assign([


            'hotgoods'  => $hotGoods, //热销商品



            'newgoods'  => $newGoods, //新品商品



            'artistlist' => $artistlist,


            'catlist'=>$catAll

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

        $catList = $this->catAll();
//        dump($catList);die;
        //新品


        $newwhere[] = ['is_del','eq','0'];
//        $newwhere[] = ['tealeafid','eq','0'];
//        $newwhere[] = ['ambitusid','eq','0'];
//        $newwhere[] = ['iron_kettleid','eq','0'];
//        $newwhere[] = ['silver_kettleid','eq','0'];
//        $newwhere[] = ['chinawareid','eq','0'];



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

                return $this->redirect('/pc_artist_detail');

            }
            if(!empty($param['is_shape'])){

                $newwhere[] = ['shapeid','in',$subId];

            }
            if(!empty($param['is_mud'])){

                $newwhere[] = ['mudid','in',$subId];


            }
            if(!empty($param['is_capacity'])){

                $newwhere[] = ['capacityid','in',$subId];

            }elseif(!empty($param['is_theme'])){

                $newwhere[] = ['themeid','in',$subId];

            }
            if(!empty($param['is_tealeaf'])){

                $newwhere[] = ['tealeafid','in',$subId];

            }
            if(!empty($param['is_ambitus'])){

                $newwhere[] = ['ambitusid','in',$subId];

            }
            if(!empty($param['is_chinaware'])){

                $newwhere[] = ['chinawareid','in',$subId];

            }
            if(!empty($param['is_iron_kettle'])){

                $newwhere[] = ['iron_kettleid','in',$subId];

            }
            if(!empty($param['is_silver_kettle'])){

                $newwhere[] = ['silver_kettleid','in',$subId];

            }

        }else{
            if(!empty($param['is_people'])){

                return $this->redirect('/pc_artist_detail?cat_id='.$param['cat_id']);

            }
            if(!empty($param['is_shape'])){

                $newwhere[] = ['shapeid','eq',$param['cat_id']];

            }
            if(!empty($param['is_mud'])){

                $newwhere[] = ['mudid','eq',$param['cat_id']];


            }
            if(!empty($param['is_capacity'])){

                $newwhere[] = ['capacityid','eq',$param['cat_id']];

            }
            if(!empty($param['is_theme'])){

                $newwhere[] = ['themeid','eq',$param['cat_id']];

            }
            if(!empty($param['is_tealeaf'])){

                $newwhere[] = ['tealeafid','eq',$param['cat_id']];

            }
            if(!empty($param['is_ambitus'])){

                $newwhere[] = ['ambitusid','eq',$param['cat_id']];

            }
            if(!empty($param['is_chinaware'])){

                $newwhere[] = ['chinawareid','eq',$param['cat_id']];

            }
            if(!empty($param['is_iron_kettle'])){

                $newwhere[] = ['iron_kettleid','eq',$param['cat_id']];

            }
            if(!empty($param['is_silver_kettle'])){

                $newwhere[] = ['silver_kettleid','eq',$param['cat_id']];

            }
        }


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

            ->paginate(24,false,['query' => request()->param()]);







        $this->assign([



            'catlist'   => $catList, //一级分类


            'newgoods'  => $newGoods, //新品商品



        ]);

        return $this->fetch();

    }

    public function selectApi()

    {

        $catList = $this->catAll();

        //新品


        $newwhere[] = ['is_del','eq','0'];
//        $newwhere[] = ['tealeafid','eq','0'];
//        $newwhere[] = ['ambitusid','eq','0'];
        $newwhere[] = ['iron_kettleid','eq','0'];
        $newwhere[] = ['silver_kettleid','eq','0'];
        $newwhere[] = ['chinawareid','eq','0'];



        $newsort = ['create_time'=>'desc'];



//        $hotsort    = ['visit'=>'desc'];

        $param = input();

        if($param['mud_id']){
            $subList=  Db('pot_category')->where('parent_id',$param['mud_id'])->select();
            $subId = array();
            foreach ($subList as $v){
                array_push($subId,$v['cat_id']);
            }
            $newwhere[] = ['mudid','in',$subId];
        }
        if($param['shape_id']){
            $subList=  Db('pot_category')->where('parent_id',$param['shape_id'])->select();
            $subId = array();
            foreach ($subList as $v){
                array_push($subId,$v['cat_id']);
            }
            $newwhere[] = ['shapeid','in',$subId];
        }
        if($param['capacity_id']){
            $newwhere[] = ['capacityid','eq',$param['capacity_id']];
        }

        if($param['ambitus_id']){
            $newwhere[] = ['ambitusid','eq',$param['ambitus_id']];
        }

        if($param['tealeaf_id']){
            $newwhere[] = ['tealeafid','eq',$param['tealeaf_id']];
        }


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

            ->paginate(24,false,['query' => request()->param()]);







        $this->assign([



            'catlist'   => $catList, //一级分类


            'newgoods'  => $newGoods, //新品商品



        ]);

        return $this->fetch('category');

    }





    public function product()

    {

        //获取header頂部分类名



        $this->catList = $this->getCategoryParentList();



        foreach($this->catList as $k=>$v){



            $cat_two = Db::name('pot_category')->where('parent_id',$v['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



            $this->catList[$k]['cat_two'] = $cat_two;

            foreach($cat_two as $kk=>$vv){



                $cat_three = Db::name('pot_category')->where('parent_id',$vv['cat_id'])->where('is_show','1')->order('sort_order','desc')->select();



                $this->catList[$k]['cat_two'][$kk]['cat_three'] = $cat_three;



            }



        }



        $this->assign('catlist',$this->catList);


        $gid = request()->param('goodsid');

        //商品浏览量+1

        $this->pot_goods->where('id',$gid)->setInc('visit');

        //商品内容

        $goodsInfo = $this->pot_goods

            ->alias('g')

            ->field('g.*,c_pid.cat_name as people_name,c_shapeid.cat_name as shape_name,c_capacityid.cat_name as capacity_name,c_themeid.cat_name as theme_name,c_mudid.cat_name as mud_name,c_mudid.keywords as mud_keywords,c_mudid.image as mud_image,c_tealeafid.cat_name as tealeaf_name,c_ambitusid.cat_name as ambitus_name,c_iron_kettleid.cat_name as iron_kettle_name,c_silver_kettleid.cat_name as silver_kettle_name')

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



        //猜你喜欢

        $likeid = $goodsInfo['like'];

        $likemap[] = ['id','in',$likeid];

        $likemap[] = ['is_del','eq','0'];

        $likesort  = ['sort'=>'desc','id'=>'desc'];

        $likeGoods = Db('pot_goods')->where($likemap)->order($likesort)->limit(0,4)->select();















        $catList = $this->catList;





        $this->assign([

            'catlist'   => $catList, //一级分类

            'info'      => $goodsInfo, //商品详情

            'link_info' => $link_goodsInfo, //作者关联商品



            'likegoods' => $likeGoods, //猜你喜欢


        ]);
//        dump($goodsInfo);

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


        $this->assign('catlist',$this->catList);

        return $this->fetch();

    }

    public function artist()
    {
        //获取頂部分类名

        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['is_people','eq','1'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
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

    public function artistList()

    {

        return $this->fetch();

    }

    public function artistDetail($cat_id='')

    {

        $catAll = $this->catAll('is_people');


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

            'goods'=>$Goods,

            'catAll'=>$catAll

        ]);

        return $this->fetch();

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

          // 新品



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

                ->paginate(24,false,['query' => request()->param()]);

        }else{



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

                ->paginate(24,false,['query' => request()->param()]);

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


        $catAll = $this->catAll();
        $page == ''?$page = 1:$page = $page;


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
            ->paginate(24,false,['query' => request()->param()]);

        if(empty($data->toArray()['data'])){

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
                ->paginate(24,false,['query' => request()->param()]);
        }

        if(empty($data->toArray()['data'])){
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
            ->paginate(24,false,['query' => request()->param()]);
        }




        $artistData = Db::name('pot_category')
            ->alias('g')
            ->field('g.*,a.position as position,a.description as description,a.img as img')
            ->join('pot_artist a','g.cat_id=a.cat_id')
            ->where([['g.is_people','eq','1'],['g.is_show','eq','1'],['g.parent_id','neq','0']])
            ->where('g.cat_name','like','%'.$param.'%')
            ->paginate(24,false,['query' => request()->param()]);



        $count = count(Db::name('pot_goods')->where('is_del',0)->where('goods_no','like',$param)->whereOr('name','like','%'.$param.'%')->select());








        $page_all = ceil($count/20);


        $this->assign([


            'catlist'=>$catAll,
            'newgoods'  => $data, //热销商品

            'page'=>$page,

            'page_all'=>$page_all,

            'search'=>$param,

            'artistData' =>$artistData

        ]);

        return $this->fetch('category');

    }

	public function about_us(){
		return $this->fetch();
	}
	
	public function teaPot(){
		return $this->fetch();
	}
	

	
	
	public function tealeaves()
	
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


}

