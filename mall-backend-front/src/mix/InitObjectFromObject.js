const config = {

    methods:{
        initObject(source, target){
            for (const key in target) {
                if (target.hasOwnProperty(key) && ( typeof source[key] != undefined ) ) {
                    target[key] = source[key]
                }
            }
        }
    },
    
};

export default config;