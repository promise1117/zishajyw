<?php
namespace app\index\controller;
use think\App;
use think\Controller;
use think\Db;

class base extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

    /**
     * @author:xiaohao
     * @time:2019/11/04 9:31
     * @return mixed
     * @description:获取分类父级
     */
    public function  getCategoryParentList(){
        $catWhere[] = ['parent_id','eq','0'];
        $catWhere[] = ['is_show','eq','1'];
        $catWhere[] = ['show_in_nav','eq','0'];
        $catSort    = ['sort_order'=>'desc','cat_id'=>'asc'];
        $catList    = Db('pot_category')->where($catWhere)->order($catSort)->select();
        return $catList;
    }

    public function cat(){

//        $catWhere[] = ['c.parent_id','eq','0'];
        $catWhere[] = ['c.is_show','eq','1'];
        $catWhere[] = ['c.show_in_nav','eq','0'];

        $catWhere[] = ['cc.is_show','eq','1'];
        $catWhere[] = ['cc.show_in_nav','eq','0'];

//        $catWhere[] = ['ccc.is_show','eq','1'];
//        $catWhere[] = ['ccc.show_in_nav','eq','0'];
        $catSort    = ['c.sort_order'=>'desc','c.cat_id'=>'asc'];

        $catList = Db('pot_category')
            ->field('c.cat_id c_cat_id,c.cat_name c_cat_name,c.parent_id c_parent_id,cc.cat_id cc_cat_id,cc.cat_name cc_cat_name,cc.parent_id cc_parent_id')
            ->alias('c')
            ->join('pot_category cc','c.parent_id=cc.cat_id','left')
//            ->join('pot_category ccc','cc.parent_id=ccc.cat_id','left')
            ->where($catWhere)
            ->order($catSort)
            ->select();

        return $catList;
    }
    //获取所有分类
    public function getCategoryParentListt(){
        $catWheret[] = ['is_show','eq','1'];
        $catSortt    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $catListt    = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($catWheret)->order($catSortt)->select();
        return $catListt;
    }
    /**
     * @author:xiaohao
     * @time:2019/11/04 9:58
     * @param $catid
     * @return mixed
     * @description:获取二级分类
     */
    public function getCategoryTwoList($catid){
        $cattWhere[] = ['parent_id','eq',$catid];
        $catWheret[] = ['is_show','eq','1'];
        $cattSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $catTowList[] = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($cattWhere)->order($cattSort)->select();
        return $catTowList;
    }
    //获取一级头像
    public function getParentImageLevel($catid){
        $catTowLists = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->field('image')->where(['cat_id'=>$catid])->find();
        return $catTowLists;
    }

    /**
     * @author:xiaohao
     * @time:2019/11/04 10:43
     * @return mixed
     * @description:获取热门
     */
    public function getCategoryHotList(){
        $cathWhere[] = ['hot','eq','1'];
        $cathWhere[] = ['is_show','eq','1'];
        $cathSort    = ['sort_order'=>'desc','cat_id'=>'desc'];
        $catTowList = Db('pot_category')->field('cat_id,cat_name,image,hot,is_show,sort_order,parent_id')->where($cathWhere)->order($cathSort)->select();
        return $catTowList;
    }

    public function carSession(){
        $shop_car = session('shop_car')?session('shop_car'):array();

        return $shop_car;

    }

}
