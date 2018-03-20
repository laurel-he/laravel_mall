<?php
namespace App\Services\Customer;

use App\Models\CustomerApp;
use App\Models\CustomerBasic;

class AttributesService
{
    /**
     * 获取客户所有属性
     */
    public function  get() 
    {
        $re = [];
        //类型
        $re['type'] = CustomerApp::getType();
        //来源
        $re['source'] = CustomerBasic::getSource();
        //资金量
        $re['property'] = CustomerBasic::getProperty();
        //客户质量
        $re['quality'] = CustomerBasic::getQuality();
        //股龄
        $re['age'] = CustomerBasic::getAge();
        //近期收益
        $re['proceeds'] = CustomerBasic::getProceeds();
        //投资风格
        $re['manner'] = CustomerBasic::getManner();
        //看盘精力
        $re['vigour'] = CustomerBasic::getVigour();
        //投资问题
        $re['question'] = CustomerBasic::getQuestion();
        //盈利模式
        $re['profit'] = CustomerBasic::getProfit();
        //态度
        $re['attitude'] = CustomerBasic::getAttitude();
        //职业
        $re['occupation'] = CustomerBasic::getOccupation();        
        //软件意向
        $re['desire'] = CustomerBasic::getDesire();
        
        return $re;
        
    }
}