<template>
    <div class="container">
        <div class="wrapp" >
            <el-row :gutter="20">
                <el-col :span="8">
                    <el-card id="one" class="box-card">
                        <div slot="header" class="head">
                            个人信息
                        </div>
                        <div id="two" style="display: table-cell;vertical-align:middle;">
                            <img :src="getUser.head" class="image"  style="width:200px;height:200px;border-radius:100%; vertical-align:middle;">

                            <div id="th" style="float:right;width:200px;border-left:1px solid #e2e2e2;line-height:180%">
                                &nbsp;&nbsp;&nbsp;<span>姓名：{{getUser.realname}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>I  D：{{getUser.id}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>职位类型：{{getUserRoles[0].display_name}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>单位：{{departName}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>Q  Q：{{getUser.qq}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>电话：{{getUser.mobilephone}}</span><br>
                                &nbsp;&nbsp;&nbsp;<span>地址：{{getUser.address}}</span>
                            </div>
                        </div>
                    </el-card>
                </el-col>
                <el-col :span="16">
                    <el-card class="box-card">
                        <div slot="header" class="head">
                            系统公告
                        </div>
                        <div>
                            <el-table :data="sysNoticeDataList" height="200"  border   style="width: 100%">
                                <el-table-column label="公告类型"  prop="type_id" align="center">
                                    <template slot-scope="scope">
                                        <span v-if="scope.row.type_id==1">功能升级</span>
                                        <span v-if="scope.row.type_id==2">新功能上线</span>
                                        <span v-if="scope.row.type_id==3">功能测试</span>
                                        <span v-if="scope.row.type_id==4">系统更新</span>
                                        <span v-if="scope.row.type_id==5">系统BUG</span>
                                        <span v-if="scope.row.type_id==6">系统维护</span>
                                        <span v-if="scope.row.type_id==7">其它公告</span>
                                    </template>
                                </el-table-column>

                                <el-table-column prop="title" label="公告标题" align="center"></el-table-column>

                                <el-table-column prop="content" label="公告内容" align="center" :show-overflow-tooltip="true"></el-table-column>
                            </el-table>
                        </div>
                    </el-card>
                </el-col>
            </el-row>

            <el-row :gutter="20">
                <el-card class="box-card2">
                    <el-tabs  id="two" class="box-card" v-model="selectedCard">
                        <el-tab-pane label="重要联系人"  name="first">
                            <el-table  :data="contactsDataList"   highlight-current-row border ref="select" style="width: 100%">
                                <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>

                                <el-table-column prop="name" label="联系人姓名" align="center"></el-table-column>

                                <el-table-column label="备注"  prop="relationship_id" align="center" :show-overflow-tooltip="true">
                                    <template slot-scope="scope">
                                        <span v-if="scope.row.relationship_id==1">父子(女)</span>
                                        <span v-if="scope.row.relationship_id==2">母子(女)</span>
                                        <span v-if="scope.row.relationship_id==3">兄弟(姐妹)</span>
                                        <span v-if="scope.row.relationship_id==4">朋友</span>
                                        <span v-if="scope.row.relationship_id==5">其他</span>
                                    </template>
                                </el-table-column>

                                <el-table-column prop="phone" label="联系人电话" align="center"></el-table-column>

                                <el-table-column prop="qq" label="联系人QQ"  align="center"></el-table-column>

                                <el-table-column prop="weixin" label="联系人微信"  align="center"></el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="常用网址" name="second">
                            <el-table  :data="WebsiteDataList"     border ref="select" style="width: 100%">
                                <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>

                                <el-table-column prop="describe" label="名称" align="center"></el-table-column>


                                <el-table-column prop="webUrl" label="网站" align="center">
                                    <template slot-scope="scope">
                                        <a :href="'http://' + scope.row.webUrl" target="_blank">{{scope.row.webUrl}}</a>
                                    </template>
                                </el-table-column>

                                <el-table-column prop="remark" label="备注"  align="center" :show-overflow-tooltip="true"></el-table-column>

                            </el-table>

                        </el-tab-pane>
                    </el-tabs>
                </el-card>

            </el-row>
        </div>



    </div>



</template>

<script>
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import SelectProxy from  '../../packages/SelectProxy';
    import ArticleAjaxProxy from '../../ajaxProxy/Article';
    import Website from '../../ajaxProxy/Website';
    import SysNotice from '../../ajaxProxy/SysNotice';
    import Contacts from '../../ajaxProxy/Contacts';
    import { mapGetters, mapMutations } from 'vuex';
    export default {
        name: 'Workbench',
        pageTitle: "我的工作台",
        mixins: [PageMix, SearchTool,DataTable],
        computed:{
            ...mapGetters([
                'getUser',
                'departName',
                'getUserRoles'
            ])
        },
        data() {
            return {
                ajaxProxy: ArticleAjaxProxy,
                mainurl:ArticleAjaxProxy,
                contactsUrl:Contacts.getUrl(),
                sysNoticeUrl:SysNotice.getUrl(),
                websiteUrl:Website.getUrl(),
                mainparam:"",
                selectedCard:'first',
                contactsDataList: [],
                WebsiteDataList: [],
                sysNoticeDataList: []
            }
        },
        methods: {
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            getSysNoticeData(){
                let selectProxy = new SelectProxy(this.sysNoticeUrl, this.sysNoticeData, this);
                selectProxy.load();
            },
            sysNoticeData(data){
                this.sysNoticeDataList=data.items;
            },
            getContactsData(){
                let selectProxy = new SelectProxy(this.contactsUrl, this.contactsData, this);
                selectProxy.setExtraParam({id:this.getUser.id});
                selectProxy.load();
            },
            contactsData(data){
                this.contactsDataList=data.items;
            },
            getWebsiteData(){
                let selectProxy = new SelectProxy(this.websiteUrl, this.websiteData, this);
                selectProxy.setExtraParam({id:this.getUser.id});
                selectProxy.load();
            },
            websiteData(data){
                this.WebsiteDataList=data.items;
            },
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            onSearchChange(param) {
                this.mainparam = JSON.stringify(param);
            },
        },
        created() {
            this.$on('search-tool-change', this.onSearchChange);
            this.getContactsData();
            this.getWebsiteData();
            this.getSysNoticeData();
            console.log(this.getUser)
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    /*#one #two{*/
    /*padding:22px;*/
    /*}*/
    .head {
        padding: 15px 20px;
        border-bottom: 1px solid #D3DCE6;
        box-sizing: border-box;
        background-color: #13ce66;
        color: #ffffff;
    }
    .container > .wrapp > {
        margin-bottom: 10px;
    }
    .box-card2{
        margin-top:  10px;
        margin-left: 10px;
        margin-right: 10px;
    }
</style>
