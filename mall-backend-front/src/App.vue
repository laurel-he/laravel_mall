<template>
  <div id="app">
    <Index v-if="isLogin"/>
    <Login v-else/>
  </div>
</template>

<script>
  // import HelloWorld from './components/HelloWorld'
  import Index from './components/Index'
  import Login from './components/Login'
  import { mapGetters, mapMutations } from 'vuex';

  export default {
      name: 'app',
      components: {
          Index,
          Login
      },
      computed:{
        ...mapGetters([
          'isLogin'
        ])
      },
      methods:{
        ...mapMutations([
              'logout'
          ]),
      },
      created(){
        const vmThis = this;
        window.onclose  = function(){
          vmThis.logout();
        }
      }
  }
</script>

<style>

  html,body{
    padding: 0px;
    margin: 0px;
  }

  .search-bar .el-form-item {
    width: 120px;
  }

  .el-cascader--small .el-cascader__label {
        line-height: 36px;
  }

  .pull-right{
    float: right;
  }
  .v--modal-overlay{
    background-color: rgba(0, 0, 0, 0.5);
  }


  .slide-fade-enter-active, .slide-fade-leave-active {
    transition: all 0.4s;
  }

  .slide-fade-enter, .slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }

  .hide{
    display: none !important;
  }

  .text-align-center{
    text-align: center;
  }

  /* .slide-fade-enter-active, .slide-fade-leave-active {
      transition: all 0.4s;
  }

  .slide-fade-enter, .slide-fade-leave-active {
      opacity: 0;
      transform: translateY(-20px);
  } */
</style>

