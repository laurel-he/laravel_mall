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
    
    import IndexAdmin from './admin/Index';
    import IndexDepart from './depart/Index';
    import IndexGroup from './group/Index';
    import IndexUser from './user/Index';

    import { mapActions,mapGetters } from 'vuex';

    export default {
        name: 'Customer',
        pageTitle: "客户资料",
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
                page_group:  false,
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
                    this.page_depart = false;
                    this.page_group = false;
                    this.page_user = false;    
                } 
            },
            setPageDepart(){
                
                if (this.$store.getters.hasRole('sale-manager')) {
                    this.page_depart = true;

                    this.page_admin = false;
                    this.page_group = false;
                    this.page_user = false;
                } 
            },
            setPageGroup(){
                if (this.$store.getters.hasRole('sale-captain')) {
                    this.page_group = true;

                    this.page_depart = false;
                    this.page_admin = false;
                    this.page_user = false;
                } 
            },
            setPageUser(){
                if (this.$store.getters.hasRole('sale-staff')) {
                    this.page_user = true;

                    this.page_depart = false;
                    this.page_group = false;
                    this.page_admin = false;
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
    .sl-bar {
        width: 100%;
        height: 10px;
        background: red;
    }
    .sl-bar:hover {
        cursor: n-resize;
    }

    .bar-wrapper-move .sl-bar{
        cursor: n-resize;
    }
</style>
