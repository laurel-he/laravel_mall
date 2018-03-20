import EditPassWord from '../EditPassWord';
import PassowrdAjaxProxy from '../../../ajaxProxy/Password';
import SearchTool from '../../../mix/SearchTool';
import getGroupsByPid from '../../../ajaxProxy/getGroupsByPid';
import DataTable from '../../../mix/DataTable';


const mix = {
    mixins: [SearchTool,DataTable,getGroupsByPid],
    components: {
        EditPassWord
    },
    data(){
        return {
            passowrdAjaxProxy:PassowrdAjaxProxy,
            searchTypes: [
                {value: 'account', name: '员工账号'},
                {value: 'realname', name: '员工姓名'},
                {value: 'mobilephone', name: '手机号'},
                {value: 'qq', name: 'QQ号'},
                {value: 'weixin', name: '微信号'},
            ],
        }
    }
};

export default mix;