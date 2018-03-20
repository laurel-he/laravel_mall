const config = {
    props:{
        name:{
            required:true,
            type:String    
        },
        width:{
            type:[String, Number],
            default:'50%'
        },
        height:{
            type:[String, Number],
            default:'auto'
        }
    },
   
    methods:{
        handleClose(){
            // this.$modal.hide(name);
            this.$modal.hide(this.name);
        }
    },


    
};

export default config;