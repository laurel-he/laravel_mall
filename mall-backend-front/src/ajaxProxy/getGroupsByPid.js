import DataProxy from '../packages/DataProxy';

const getGroupsByPid = {

    methods:{
        getGroupsAjax(v){
            let dataProxy = new DataProxy('/getGroupsByPid/'+v,this.pageSize,this.getGroups, this,);
            dataProxy.load();
        },
        getGroups(data){
            this.groups=data.items;
        }
    }
};

export default getGroupsByPid;
