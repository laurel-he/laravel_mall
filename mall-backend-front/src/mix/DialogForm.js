import FormMix from './Form';
import Dialog from './Dialog';

const DialogForm = {
    mixins:[FormMix, Dialog],
    props:{
        ajaxProxy:{
            // required:true,
            type: Object,
            default: null
        }
    },
    created(){
        this.$on('submit-success', this.handleClose);
    }
};

export default DialogForm;