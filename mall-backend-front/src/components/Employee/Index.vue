<template>
    <div>
        <IndexAdmin v-if="isAdmin"/>
        <IndexDepart v-if="isDepart"/>

    </div>
</template>
<script>
    import PageMix from '../../mix/Page';
    import EditPassWord from './EditPassWord';
    import IndexAdmin from './Admin/IndexAdmin';
    import IndexDepart from './Depart/IndexDepart';

    import { mapActions,mapGetters } from 'vuex';

    export default {
        name: 'Employee',
        pageTitle: "员工管理",
        mixins: [PageMix],
        components: {
            IndexAdmin,
            IndexDepart
        },
        data() {
            return {
                page_admin: false,
                page_depart: false, 
            }
        },
        computed:{
            isAdmin(){
                return this.page_admin;
            },
            isDepart(){
                return this.page_depart;
            }
        },
        methods: {
            setPageAdmin(){
                if (this.$store.getters.hasRole('administrator') || 
                    this.$store.getters.hasRole('super-manager')) {
                    this.page_admin = true;
                } 
            },
            setPageDepart(){
                if (this.$store.getters.hasRole('department-manager')) {
                    this.page_depart = true;
                } 
            }

        },
        created() {
            this.setPageAdmin();
            this.setPageDepart();
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
