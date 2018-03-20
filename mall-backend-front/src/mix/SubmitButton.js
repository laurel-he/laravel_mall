import SubmitButton from '../components/common/SubmitButton';
//这个mix不用了
const config = {
    components:{SubmitButton},
    data(){
        return {
            submiteStatus:false
        }
    },
    methods:{
        setSubmiting(){
            this.submiteStatus = true;
        },
        setSubmited(){
            console.log(this.submiteStatus);
            this.submiteStatus = false;
        }
    }
};

export default config;