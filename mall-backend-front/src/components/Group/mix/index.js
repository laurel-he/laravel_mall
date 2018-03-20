const mix = {

    methods:{
        groupManager(items){
            let unasign = [];
            let sign = [];
            for (let index = 0; index < items.length; index++) {
                var element = items[index];
                if (element.group) {
                    sign.push({id:element.id, realname:element.realname, group_name:element.group.name});
                } else {
                    unasign.push({id:element.id, realname:element.realname, group_name:""});
                }
                
            }

            let re = {};
            re.unsign = unasign;
            re.sign = sign;

            return re;
        }
    }
};


export default mix;