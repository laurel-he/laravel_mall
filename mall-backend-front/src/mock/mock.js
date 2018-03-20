var Mock = require('mockjs');
var Random = Mock.Random
Mock.setup({
    timeout: '200-600'
})

Mock.mock(/\/MsgBox\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'title': Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@csentence(4,6)'),
        'time':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
        'operator':Mock.mock('@cname(2,3)')
    }],
    'total':400
});

Mock.mock(/\/SysNotice\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'type': Mock.mock('@ctitle(3,6)'),
        'title': Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@csentence(4,6)'),
        'start':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
        'end':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
        'user':Mock.mock('@cname(2,3)'),
    }],
    'total':400
});


Mock.mock(/\/DepartmentNotice\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'type': Mock.mock('@ctitle(3,6)'),
        'title': Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@csentence(4,6)'),
        'user':Mock.mock('@cname(2,3)'),
    }],
    'total':400
});

Mock.mock(/\/GatherAdvice\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'type': Mock.mock('@ctitle(3,6)'),
        'title': Mock.mock('@ctitle(3,6)'),
        'advice': Mock.mock('@csentence(4,6)'),
        'time': Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
        'content':Mock.mock('@csentence(4,6)'),
        'ad_user':Mock.mock('@cname(2,3)'),
        'reply':Mock.mock('@csentence(4,6)'),
        're_user':Mock.mock('@cname(2,3)'),
        're_time':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
    }],
    'total':400
});

Mock.mock(/\/WorkSummary\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'type': Mock.mock('@ctitle(3,6)'),
        'title': Mock.mock('@ctitle(3,6)'),
        'su_time': Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
        'content':Mock.mock('@csentence(4,6)'),
        'su_user':Mock.mock('@cname(2,3)'),
        'reply':Mock.mock('@csentence(4,6)'),
        're_user':Mock.mock('@cname(2,3)'),
        're_time':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
    }],
    'total':400
});


Mock.mock(/\/RegisterInfo\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'wx': Mock.mock('@ctitle(3,6)'),
        'phone': Mock.mock('@integer(13500000000, 13590000000)'),
        'ip':Mock.mock('@ip'),
        'location':Mock.mock('@county(true)'),
        'lock':Mock.mock('@integer(0, 2)'),
        'leadin':Mock.mock('@cname(2,3)'),
        'reg_time':Mock.mock('@date("yyyy-MM-dd H:m:s ")'),
    }],
    'total':400
});


Mock.mock(/\/Department\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@ctitle()'),
        'typeText': Mock.mock('@ctitle(3,6)'),
        'tel': Mock.mock('@integer(13500000000, 13590000000)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'contact':Mock.mock('@cname()'),
        'status':Mock.mock('@integer(0, 1)'),
        'switch':true,
    }],
    'total':400
});



Mock.mock(/\/DepartmentDivision\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@ctitle()'),
        'brief': Mock.mock('@ctitle(3,6)'),
    }],
    'total':400
});

// {departmentname:'推广二部',name:'超越队',realname:'李青',phone:'13526458712',status:'0',switch:true,remark:'推广部王牌'},
// {user_id:'123',type:'队员',realname:'李青',phone:'13526458712',qq:'1245624'},

Mock.mock(/\/Group\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'departmentname': Mock.mock('@ctitle()'),
        'name': Mock.mock('@ctitle(3,6)'),
        'realname': Mock.mock('@cname()'),
        'phone': Mock.mock('@integer(13500000000, 13590000000)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'status':Mock.mock('@integer(0, 1)'),
        'switch':true,
    }],
    'items1|5': [{
        'id|+1': 1,
        'user_id':Mock.mock('@integer(1,100)'),
        'type': Mock.mock('@ctitle(3,6)'),
        'realname': Mock.mock('@cname()'),
        'phone': Mock.mock('@integer(13500000000, 13590000000)'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),

    }],
    'total':400
});


Mock.mock(/\/Employee\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'account': Mock.mock('@ctitle()'),
        'realname': Mock.mock('@cname()'),
        'department_name': Mock.mock('@ctitle()'),
        'head': Mock.mock('@ctitle()'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'role': Mock.mock('@ctitle()'),
        'sex': '男' || '女',
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'mphone': Mock.mock('@integer(13500000000, 13590000000)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'status':Mock.mock('@integer(0, 1)'),
        'id_card':Mock.mock('@integer(51072211111111, 9999999999999999)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),
        'weixin':Mock.mock('@ctitle(4,6)'),
        'weixin_nikname':Mock.mock('@ctitle(4,6)'),
        'address':Mock.mock('@county(true)'),
        'ip':Mock.mock('@ip'),
        'location':Mock.mock('@county(true)'),
        'lg_time':Mock.mock('@now()'),
        'out_time':Mock.mock('@now()'),
        'created_at':Mock.mock('@now()'),
        'creator':Mock.mock('@cname()'),
    }],

    'total':400
});


Mock.mock(/\/Role\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'status':true || false,

    }],

    'total':400
});

Mock.mock(/\/Node\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@ctitle(4,6)'),
        'type':Mock.mock('@ctitle(3,6)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'status':true || false,

    }],

    'total':400
});



Mock.mock(/\/Menu\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@ctitle(4,6)'),
        'type':Mock.mock('@ctitle(3,6)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'status':true || false,

    }],

    'total':400
});



Mock.mock(/\/Customer\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'realname':Mock.mock('@cname()'),
        'lock_name':Mock.mock('@cname()'),
        'status':true || false,
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'weixin_nickname':Mock.mock('@ctitle(3,6)'),
        'dis_time':Mock.mock('@now()'),
        'recommend': Mock.mock('@ctitle(1)'),
        'important': Mock.mock('@ctitle(1)'),
        'province_name': Mock.mock('@ctitle(4,6)'),
        'last_track':Mock.mock('@now()'),
        'plan':Mock.mock('@now()'),
        'conflict':Mock.mock('@now()'),
        'share_benefit':Mock.mock('@integer(0.1, 0.9)'),
        'sex':'男' || '女',
    }],

      'items1|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@ctitle(3,6)'),
        'track_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],
    'items2|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'content':Mock.mock('@ctitle(3,6)'),
        'type_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],

    'total':400
});



Mock.mock(/\/DistributeCustomerB\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'realname':Mock.mock('@cname()'),
        'lock_name':Mock.mock('@cname()'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),
        'weixin':Mock.mock('@ctitle(4,6)'),
        'weixin_nickname':Mock.mock('@ctitle(4,6)'),
        'recommend': Mock.mock('@ctitle(1)'),
        'sex':'男' || '女',
        'province_name':Mock.mock('@county(true)'),
    }],

      'items1|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@ctitle(3,6)'),
        'track_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],
    'items2|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'content':Mock.mock('@ctitle(3,6)'),
        'type_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],

    'total':400
});


Mock.mock(/\/CounselArticle\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'type_text': Mock.mock('@ctitle(4,6)'),
        'title': Mock.mock('@ctitle(4,6)'),
        'content':Mock.mock('@ctitle(3,6)'),
        'creator':Mock.mock('@ctitle(3,6)'),
    }],

    'total':400
});

Mock.mock(/\/EmployeeSelect\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'realname':Mock.mock('@cname()'),
        'department_name':Mock.mock('@ctitle(3,6)'),
        'mphone': Mock.mock('@integer(028100000, 28900000)'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),
        'weixin':Mock.mock('@ctitle(4,6)'),
        'weixin_nikname':Mock.mock('@ctitle(4,6)'),

    }],

    'total':400
});


Mock.mock(/\/MakeOrder\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'cus_name':Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'realname':Mock.mock('@ctitle(3,6)'),
        'semaster':Mock.mock('@cname()'),
        'semaster_time':Mock.mock('@now()'),
        'order_time':Mock.mock('@now()'),
        'buy_time':Mock.mock('@now()'),
        'mphone': Mock.mock('@integer(028100000, 28900000)'),
        'product_name':Mock.mock('@ctitle(3,6)'),
        'pay_info':Mock.mock('@ctitle(3,6)'),
    }],

    'total':400
});

Mock.mock(/\/PreCheck\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@cname()'),
        'spread_name':Mock.mock('@ctitle(3,6)'),
        'type|1':["A",'B','C','D','E','F' ],
        'user_name':Mock.mock('@cname()'),
        'created_at':Mock.mock('@now()'),
    }],

    'total':400
});

Mock.mock(/\/DepartmentCustomer\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'realname':Mock.mock('@cname()'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'last_track':Mock.mock('@now()'),
        'plan':Mock.mock('@now()'),
        'conflict':Mock.mock('@now()'),
        'share_benefit|1':["2/5",'3/8','4/7'],
        'sex|1':["男",'女'],
        'province_name':Mock.mock('@county(true)'),
    }],
    'items1|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'content':Mock.mock('@ctitle(3,6)'),
        'track_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],
'items2|5': [{
        'id|+1': 1,
        'user': Mock.mock('@cname()'),
        'content':Mock.mock('@ctitle(3,6)'),
        'type_text':Mock.mock('@ctitle(3,6)'),
        'created_at':Mock.mock('@now()'),
    }],
    'total':400
});



Mock.mock(/\/Products\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@ctitle(3,6)'),
        'price|1':["8888",'9999','6666'],
        'service_cycle|1':["12个月",'24个月'],
        'upgrade|1':["12个月",'24个月'],
        'status|1':["1",'-1'],
        'mark':Mock.mock('@ctitle(3,6)'),
        'operator':Mock.mock('@cname()'),
        'time':Mock.mock('@now()'),

    }],

    'total':400
});


Mock.mock(/\/SpreadDepartmentCustomer\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
        'type':Mock.mock('@ctitle(3,6)'),
        'realname':Mock.mock('@cname()'),
        'lock_name':Mock.mock('@cname()'),
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'qq_nickname':Mock.mock('@ctitle(4,6)'),

        'share_benefit|1':["2/5",'3/8','4/7'],
        'sex|1':["男",'女'],


    }],

    'total':400
});


Mock.mock(/\/AchievementRank\?pageSize\=\d+\&page\=\d+/, {
    'items|1-5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
    }], 'items1|1-5': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
    }], 'items2|10': [{
        'id|+1': 1,
        'name': Mock.mock('@cname()'),
    }],

    'total':400
});


Mock.mock(/\/Performance\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@ctitle(3,6)'),
        'self_num':10,
        'self_amount':100,
        'spread_num':10,
        'spread_amount':20,
        'order_num':30,
        'sale_amount':10000,
    }],
    'items1': [{
        'id|+1': 1,
        'name':'汇总',
        'sum_self_num':50,
        'sum_self_amount':500,
        'sum_spread_num':50,
        'sum_spread_amount':100,
        'sum_order_num':150,
        'sum_sale_amount':50000,
    }],

    'total':400
});



Mock.mock(/\/PerformanceForSpread\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@ctitle(3,6)'),
        'order_num':10,
        'sale_amount':10000,
    }],
    'items1|5': [{
        'id|+1': 1,
        'customer_name': Mock.mock('@cname()'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'mphone': Mock.mock('@integer(028100000, 28900000)'),
        'product_name':Mock.mock('@ctitle(3,6)'),
        'paid_in':'100',
        'buy_time':'2017-10-12 15:52:12',
        'created_at':'2017-10-12 15:52:12',
        'user_name':Mock.mock('@cname()'),
        'sale_name':Mock.mock('@cname()'),
    }],
    'items2': [{
        'id|+1': 1,
        'name':'汇总',
        'sum_order_num':150,
        'sum_sale_amount':50000,
    }],


    'total':400
});



Mock.mock(/\/QuantizationCount\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@ctitle(3,6)'),
        'self_lock':10,
        'self_lock_track':10000,
        'assign':0,
        'assign_track':1,
        'trade':3,
        'get_cus':1,
        'assign_track_per':'10%',
        'assign_trade_per':'50%',
    }],



    'total':400
});


Mock.mock(/\/SpreadQuantizationCount\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'name':Mock.mock('@ctitle(3,6)'),
        'spread_lock':10,
        'self_lock_track':10000,
        'recommend_num':1,
        'spread_trade':3,
        'get_cus':6,

    }],



    'total':400
});



Mock.mock(/\/TradeCustomers\?pageSize\=\d+\&page\=\d+/, {
    'items|5': [{
        'id|+1': 1,
        'address':Mock.mock('@ctitle(3,6)'),
        'created_at':'2017-10-12 15:52:12',
        'customer_name':Mock.mock('@cname()'),
        'deal_time':'2017-10-12 15:52:12',
        'created_time':'2017-10-12 15:52:12',
        'lock_name': Mock.mock('@cname()'),
        'money':10000,
        'qq': Mock.mock('@integer(1000000, 9999999)'),
        'phone': Mock.mock('@integer(028100000, 28900000)'),
        'remark':Mock.mock('@ctitle(3,6)'),
        'server_id':0,
        'server_name':Mock.mock('@cname()'),
        'track_name':Mock.mock('@cname()'),
        'sex|1':['男','女'],
        'weixin':114465465,
    }],
    'total':400
});
Mock.mock(/\/RiskCheck\?pageSize\=\d+\&page\=\d+/, {
    'items|2': [{
        name:'张三',
        type_text:'普通客户',
        phone:'1352123542',
        qq:'654123552',
        weixin:'fdsfsd',
        address:'成都市',
        id_card:'15645555555555',
        user:'李四',
        user_phone:'1374542445',
        state_text:'通过',
        time_text:'2016-10-23 17:30:14',
        type:'精品',
        product_name:'23',
        product_money:'30000',
        buy_time:'2016-10-23 17:30:14',
        dis_time:'2016-10-23 17:30:14',
        qq2:'3465465465',
        qq_nickname2:'规定发给',
        phone2:'1344646548',
        weixin2:'sgs',
        weixin_nickname2:'好地方'},
    ],
'items1|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        track_text:'荆防颗粒'}
],
'items2|2':[
    {
        product_money:'8888',
        product_name:'黄金一号',
        product_t:'24个月',
        buy_time:'2017-12-01 15:45:12'
    }
],
'items3|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        type_text:'不满意'}
],
    'total':400
});



Mock.mock(/\/BuyCheck\?pageSize\=\d+\&page\=\d+/, {
    'items|2': [{
        type:'购买',
        cb_name:'李四',
        realname:'李曼曼',
        product_name:'点金手高端版',
        product_money:'1888',
        state_text:'待审核',
      },
    ],
'items1|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        track_text:'荆防颗粒'}
],
'items2|2':[
    {
        product_money:'8888',
        product_name:'黄金一号',
        product_t:'24个月',
        buy_time:'2017-12-01 15:45:12'
    }
],
'items3|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        type_text:'不满意'}
],
    'total':400
});


Mock.mock(/\/RiskManager\?pageSize\=\d+\&page\=\d+/, {
    'items|2': [{
        type:'购买',
        cb_name:'李四',
        db_realname:'李曼曼',
        product_name:'点金手高端版',
        product_money:'8888',
        risk_state:'通过',
        risk_name:'审查专员',
        callback_state:'通过',
        callback_name:'回访A',
        buy_time:'2017-11-28',
        datastaff_name:'刘科',
        status:'已开单',
      },
    ],
'items1|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        track_text:'荆防颗粒'}
],
'items2|2':[
    {
        product_money:'8888',
        product_name:'黄金一号',
        product_t:'24个月',
        buy_time:'2017-12-01 15:45:12'
    }
],
'items3|2':[
    {
        user:'李四',
        content:'跟踪狂',
        created_at:'2017-12-01 15:45:12',
        type_text:'不满意'}
],
    'total':400
});

Mock.mock('/departments?type=sale&pageSize=1000&page=1',{
    'items|5':[{
        'id|+1':1,
        'name':Mock.mock('@ctitle(2,3)')
    }],

},);


Mock.mock('/groups?depart_id=1&pageSize=1000&page=1',{
    'items|5':[{
        'id|+1':1,
        'name':Mock.mock('@ctitle(2,3)')
    }],

},

);


Mock.mock('/employees?depart_id=1&group_id=1&pageSize=1000&page=1',{
    'items|5':[{
        'id|+1':1,
        'name':Mock.mock('@ctitle(2,3)')
    }],

},

);

export default Mock;