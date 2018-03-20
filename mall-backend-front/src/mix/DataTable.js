import TableProxy from '../components/common/TableProxy';
//这个 mix 只能 用于 主 table  副table 用不了
const config = {
    components:{TableProxy},
    data(){
        return {
            
            dataTableReload:1,
        }
    },
    methods:{
        handleReload(){
            this.dataTableReload++;
        }
    }
};

export default config;