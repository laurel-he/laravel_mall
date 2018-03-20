const mix = {
    methods:{
        trasnGroupToOptions(option){
            let re = [];
            for (let index = 0; index < option.length; index++) {
                var element = option[index];
                var children = [];
                if (element.users) {
                    children =  this.trasnGroupToOptions(element.users);
                }
                var result = {value:element.id, label:element.name ? element.name : element.realname};
                if (children.length > 0) {
                    result.children = children;
                }
                re.push(result);
            }
            return re;
        }
    }  
};

export default mix;