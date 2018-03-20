import DataProxy from '../packages/DataProxy';

const getDepartmentByType = {

    methods:{
        getDepartmentsAjax(v){
            let dataProxy = new DataProxy('/getDepartmentByType/'+v,this.pageSize,this.getDepartments, this,);
            dataProxy.load();
        },
        getDepartments(data){
            this.departments=data.items;
        }
    }
};

export default getDepartmentByType;
