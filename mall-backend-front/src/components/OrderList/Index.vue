<template>
    <div>
        <IndexAdmin v-if="isAdmin"/>
        <IndexDepart v-if="isDepart"/>
        <IndexGroup v-if="isGroup"/>
        <IndexUser v-if="isUser"/>

    </div>
</template>
<script>
    import PageMix from '../../mix/Page';

    import IndexAdmin from './Admin/IndexAdmin';
    import IndexDepart from './Depart/IndexDepart';
    import IndexGroup from './Group/IndexGroup';
    import IndexUser from './User/IndexUser';

    import { mapActions,mapGetters } from 'vuex';

    export default {
        name: 'OrderList',
        pageTitle:"订单详情",
        mixins: [PageMix],
        components: {
            IndexAdmin,
            IndexDepart,
            IndexGroup,
            IndexUser
        },
        data() {
            return {
                page_admin: false,
                page_depart: false, 
                page_group: false,
                page_user: false
            }
        },
        computed:{
            isAdmin(){
                return this.page_admin;
            },
            isDepart(){
                return this.page_depart;
            },
            isGroup(){
                return this.page_group;
            },
            isUser(){
                return this.page_user;
            }
        },
        methods: {
            setPageAdmin(){
                if (this.$store.getters.hasRole('administrator') || 
                    this.$store.getters.hasRole('super-manager')) {
                    this.page_admin = true;

                    this.page_depart=false;
                    this.page_group= false;
                    this.page_user= false;
                } 
            },
            setPageDepart(){
                
                if (this.$store.getters.hasRole('sale-manager')) {
                    this.page_depart = true;

                    this.page_admin = false;
                    this.page_group= false;
                    this.page_user= false;
                } 
            },
            setPageGroup(){
                if (this.$store.getters.hasRole('group-captain')) {
                    this.page_group = true;

                    this.page_admin = false;
                    this.page_depart = false;
                    this.page_user= false;
                } 
            },
            setPageUser(){
                if (this.$store.getters.hasRole('group-member')) {
                    this.page_user = true;

                    this.page_admin = false;
                    this.page_depart = false;
                    this.page_group = false;
                } 
            }

        },
        created() {
            this.setPageUser();
            this.setPageGroup();
            this.setPageDepart();
            this.setPageAdmin();
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
