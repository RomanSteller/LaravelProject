<template>
<div>
  <div class="header">
    <div class="container header_container">
      <div class="header_logo">
        <img src="storage/logo/logo.png" alt="LOGO">
      </div>
      <div class="header_user_nickname">
        <div class="header_search">
          <input type="text" v-if="visibleInput">
          <button @click="switchInput">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </div>
        <h2>Steellsey</h2>
      </div>
    </div>
  </div>
  <div class="main_container container">
    <div class="content">
      <nav>
        <ul>
          <li><router-link :to="{name:'articles'}">Статьи</router-link></li>
          <li><a href="#">Новости</a></li>
          <li><a href="#">Авторы</a></li>
        </ul>
      </nav>
      <div class="switch_sort">
        <div class="switch_best_or_all">
          <ul>
            <li><a href="#">Всё</a></li>
            <li><a href="#">Лучшее</a></li>
          </ul>
        </div>
        <div class="switch_of_time">
          <ul>
            <li><a href="#">Сегодня</a></li>
            <li><a href="#">Неделя</a></li>
            <li><a href="#">Всё время</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="charts">
      <div class="tops">
        <div class="top_text">
          <a href=""><h2>Топ публицистов</h2></a>
        </div>
        <div class="top_publicists">

          <div class="publicist">
            <div class="publicist_data">
              <div class="publicist_logo">

              </div>
              <div class="publicist_name">
                <a href=""><h3>Steellsey</h3></a>
              </div>
            </div>
            <div class="publicist_views">
              <span>228</span>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
</template>

<script>
export default {
  name: "header",
  data(){
    return{
      visibleInput:false
    }
  },
  methods:{
    switchInput(){
      this.visibleInput = !this.visibleInput;
    }
  }
}
</script>

<style scoped>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body{
  font-family: 'Helvetica', sans-serif;
}

.header{
  background-color: #303b44;
}

.container{
  max-width:1300px;
  margin: 0 auto;
  padding: 0 10px;
}

a{
  text-decoration: none;
}

.header_container{
  display: flex;
  justify-content: space-between;
  align-items: center;
}


.header_logo{
  padding: 5px;
}


.header_user_nickname{
  color: white;
  font-size: 25px;
}

.header_user_nickname{
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header_search{
  margin-right: 20px;
  align-items: center;
}

.header_search input{
  outline: none;
  border: none;
  padding: 5px 20px;
}

button{
  background: none;
  border: none;

}

.main_container{
  display: flex;
  justify-content: space-between;
  margin-top:30px;
}

.content nav>ul>li>a{
  text-decoration: none;
  color: black;
  font-size: 25pt;
}

.content nav>ul>li{
  padding: 0 10px;

}

.content{
  max-width: 800px;
  width: 100%;
  padding: 0 5px;
}

.content nav>ul>li:not(:last-child){
  border-right: 1px solid black;
}

.content nav>ul>li:first-child{
  padding-left: 0;
}

li{
  list-style: none;
}

.content nav>ul{
  display: flex;
}

.switch_sort{
  display: flex;
  justify-content: space-between;
  margin-top: 40px;
}

.switch_best_or_all,
.switch_of_time{
  display: flex;
  justify-content: space-between;
}

.switch_best_or_all ul ,
.switch_of_time  ul{
  display: flex;
  margin-right: 10px;
  font-size: 26px;

}

.switch_best_or_all ul>li>a ,
.switch_of_time  ul>li>a{
  color: black;
  padding: 5px;

}

.switch_best_or_all ul>li>a ,
.switch_of_time  ul>li>a{
  text-align: center;
}

.switch_best_or_all ul,
.switch_of_time ul{

}


.switch_best_or_all ul>li> ,
.switch_of_time  ul>li>{
  margin: -2px;
  padding: 15px 0;
}

.switch_best_or_all ul>li>a:active ,
.switch_of_time  ul>li>a:active{
  border: 1px solid cornflowerblue;
  margin: -1px;
}

.switch_best_or_all ul>li:last-child,
.switch_of_time  ul>li:last-child{
  margin-right: 0;
}

.switch_sort{
  position: relative;
  border-bottom: 1px solid #77a8d0;
  padding-bottom: 20px;
}

.charts{
  position: relative;
  max-width: 400px;
  width: 100%;
  padding: 0 5px;
}

.top_text{
  border-bottom: 2px solid  #77a8d0;
  padding-bottom: 10px;
}

.top_text h2{
  font-weight: normal;
  color: #222222;
}


.publicist_logo{
  width: 30px;
  height: 30px;
  background-color: #77a8d0;
  border-radius: 2px;
}

.top_publicists{
  margin-top:30px;

}

.publicist{
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.publicist_data{
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}

.publicist_name{
  margin-left: 7px;
}
.publicist_name a{
  color: #222222;
}

span{
  font-weight: lighter;
}

.top_articles{
  margin-top: 70px;
}

.articles{
  margin: 15px 15px 0;
  padding-bottom: 5px;
  border-bottom: 1px solid #77a8d0;
}

.article_name{
  margin-top: 15px;
}
.article_name a{
  color: #222222;
}
.article_statistic{
  margin-top: 5px;
}

.post_user_logo{
  width: 30px;
  height: 30px;
  background-color: cornflowerblue;
  border-radius: 15px;
}

.post_user{
  margin-top: 30px;
  display: flex;
  align-items: flex-end;
  flex-direction: row;
}
.post_user_name{
  color: #222222;
}

.post_user div:not(post_date_time){
  margin-right: 10px;
}

.post_name{
  margin: 20px 0 5px;
}
.post_name a{
  color: #222222;
}
.post_tags a{
  margin-right: 5px;
  color: #222222;
}
.post_content{
  margin-top: 15px;
  font-size: 18px;
  color: #222222;
}
.post_content *{
  width: 100%;
}
.post_statistic{
  margin-top: 5px;
  display: flex;
  align-items: center;
}
.post_statistic div{
  margin-right: 10px;
}
.post_statistic span{
  margin-left: 3px;
}

.articles{
  margin-top: 30px;
}

</style>