<template>
    <div>
        <ul v-for="article in articles" :key="article.id">
          <li>{{article.name}}</li>
          <li v-html="article.content"></li>
        </ul>
    </div>
</template>

<script>
export default {
  name: "v-articles",
  data(){
    return{
      articles:[]
    }
  },
  mounted() {
    this.allArticles();
  },
  methods:{
    allArticles(){
      axios.get('/api/get-articles')
      .then(res=>{
        this.articles = res.data[0];

        console.log(this.articles)
      })
    }
  }
}
</script>

<style scoped>
  ul{
    margin-top: 30px;
  }
</style>
