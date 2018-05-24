import RoleAjaxProxy from '../../ajaxProxy/Role';

const app = {
    state: {
        roles:[],
        assignable:[],
    },

    getters:{
        roles(state){
            return state.roles;
        },
        assignable(state){
            return state.assignable;
        },
        
    },

    mutations:{
        setRoles(state, roles){
            state.roles = roles;
        },

        setAssigable(state, roles){
            state.assignable = roles;
        }
        
    },

    actions:{
        getRoles(context){
            RoleAjaxProxy.get().then((response)=>{
                context.commit('setRoles', response.data.items);
            }).catch(data => {
                console.log(data);
            })
            
        },
        getAssignRoles(context) {
            RoleAjaxProxy.getAssignRoles().then((response)=>{
                context.commit('setAssigable', response.data.items);
            }).catch(data => {
                console.log(data);
            })
        }
    }
};


export default app;