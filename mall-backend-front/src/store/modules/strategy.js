//显示 隐藏 禁用 策略
import Strategy from '../../strategy';

const strategy = {
    state: {
        // 'Group':{
        //     'department-manager':{

        //     }
        // },
    },

    getters:{
        getStrategy : (state, getters)=>(name)=> {
            // console.log(rootState);
            // console.log(getters);
            let roles = getters.getUserRoles;
            let strategies =  Strategy[name] ? Strategy[name] : [];

            if (roles.length > 0) {
                for (let index = 0; index < roles.length; index++) {
                    var element_name = roles[index].name;
                    if (strategies[element_name]) {
                        return strategies[element_name];
                    }   
                }
            }

            return null;

        },
    }
};

export default strategy;