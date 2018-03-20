<template>
    <div>
        <IndexAdmin v-if="isAdmin"/>
        <IndexSale v-else />

    </div>
</template>
<script>
    import PageMix from '../../mix/Page';
    import IndexAdmin from './Admin/Index.vue';
    import IndexSale from './Sale/Index.vue';

    import { mapActions,mapGetters } from 'vuex';

    export default {
        name: 'GoodsDetails',
        pageTitle: "商品详情",
        mixins: [PageMix],
        components: {
            IndexAdmin,
            IndexSale
        },
        data() {
            return {
                page_admin: false, 
            }
        },
        computed:{
            isAdmin(){
                return this.page_admin;
            },
            
        },
        methods: {
            setPageAdmin(){
                if (this.$store.getters.hasRole('administrator') || 
                    this.$store.getters.hasRole('super-manager')) {
                    this.page_admin = true;
                } 
            },
            

        },
        created() {
            this.setPageAdmin();
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >
    .table-expand .el-form-item {
        width: 40%;
    }
</style>
