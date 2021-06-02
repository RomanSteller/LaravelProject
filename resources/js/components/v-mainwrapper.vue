<template>

</template>

<script>
import axios from 'axios';
export default {
  name: "v-mainwrapper",
  mounted() {
    this.allArticles()
  },
  methods:{
    allArticles(){
      axios.get('api/get-articles')
          .then(res=>{
            console.log(res.data);
          })
    }
  }
}
</script>

<style scoped>


</style>