<template>
  <div >
      <el-menu :unique-opened="true" theme="dark" @select="handleSelect" >
       <el-submenu v-for="(ni,index) in nav" :key="index" :index="index+''" >
        <template slot="title">
          <i v-if="ni.icon" :class="ni.icon"></i>
          {{ ni.text }}
        </template>
        <el-menu-item  v-for="sub in ni.subNav"  :key="sub.index" :index="sub.index+''"> {{ sub.text }} </el-menu-item>
      </el-submenu>
      
    </el-menu>
  </div>
</template>

<script>
import NavAjax from '../ajaxProxy/Nav';
export default {
  name: 'Navgation',
  data () {
    return {
      nav:[
        {
          text:"加载中",
          icon:null
        },
      ]  
    }
  },
  methods:{
      handleSelect(key, keyPath) {
          //console.log(key);
         // console.log(keyPath);
        this.$emit("nav-change", key);
      }
  },
  created(){
    NavAjax.getNav().then(data=>{
       //console.log(data);
      // console.log(this.nav);
      this.nav = data.data;
    });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >

</style>
