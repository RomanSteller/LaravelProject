
<template>
  <div>
      <!--    <div class="alert alert-danger" role="alert" v-if="errorExists">-->
      <!--      {{errorText}}-->
      <!--    </div>-->

    <form action="" v-if="!toogleForm">

      <p>Регистрация</p>
      <div class="alert alert-success" role="alert" v-if="successRegister">
        {{successRegisterText}}
      </div>
      <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" id="login" name="login" v-model="regForm.login">
        <span v-if="failLogin">{{ failLoginMessage }}</span>
      </div>
      <div class="form-group">
        <label for="name">ФИО</label>
        <input type="text" id="name" name="name" v-model="regForm.name">
        <span v-if="failName">{{ failNameMessage }}</span>
      </div>
      <div class="form-group">
        <label for="email">Электронная почта</label>
        <input type="text" id="email" name="email" v-model="regForm.email">
        <span v-if="failEmail">{{ failEmailMessage }}</span>
      </div>
      <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" v-model="regForm.password">
        <span v-if="failPassword">{{ failPasswordMessage }}</span>
      </div>
      <div class="form-group">
        <label for="password_repeat">Повтор пароля</label>
        <input type="password" id="password_repeat" name="confirmed_password" v-model="regForm.confirmed_password">
        <span v-if="failSecondPassword">{{ failSecondPasswordMessage }}</span>
      </div>
      <input type="submit" @click.prevent="createUser">
      <a href="" @click.prevent="switchForm">Я зарегестрирован</a>
    </form>

    <form action="" v-if="toogleForm">
      <div class="alert alert-danger text-center" role="alert" v-if="authFail">
        {{failAuthMessage}}
      </div>
      <p>Авторизация</p>
      <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" id="auth_login" v-model="authForm.login">
        <span v-if="failLogin">{{ failLoginMessage }}</span>
      </div>
      <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="auth_password" v-model="authForm.password">
        <span v-if="failPassword">{{ failPasswordMessage }}</span>
      </div>
      <input type="submit" @click.prevent="authUser">
      <a href="" @click.prevent="switchForm">У меня нет аккаунта</a>
    </form>
  </div>

</template>

<script>
import axios from 'axios'
export default {
  name: "authForm",
  data(){
    return{
      toogleForm:true,
      failLogin:false,
      failPassword:false,
      failSecondPassword:false,
      failName:false,
      failEmail:false,
      successRegister:false,
      authFail:false,
      failAuthMessage:"",
      regForm:{
        login:"",
        name:"",
        password:"",
        confirmed_password:"",
        email:""
      },
      authForm:{
        login:'',
        password:''
      },
      successRegisterText:"",
      errorExists:false,
      errorText:"",

      failLoginMessage:"",
      failPasswordMessage:"",
      failSecondPasswordMessage:"",
      failEmailMessage:"",
      failNameMessage:"",
    }
  },
  methods:{
    switchForm(){
      this.toogleForm = !this.toogleForm
    },
    createUser(){
      axios.post('api/create-user',this.regForm,{
        headers:{
          "Content-type":"application/json",
          'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      }).then(res=>{
        if(res.data.message){
          this.successRegisterText = res.data.message
          this.successRegister = true;
        }

      }).catch(err=>{
        // console.log(err.response.data)
        // console.log(err.response.data.errors.message.login)

        if (err?.response?.data?.errors) {
          if(err.response.data.errors.login){
              this.failLogin = true;
              this.failLoginMessage = err.response.data.errors.login[0]
              console.log(this.failLoginMessage);
          }else{
              this.failLogin=false
          }

          if(err.response.data.errors.password){
            this.failPassword = true;
            this.failPasswordMessage = err.response.data.errors.password[0]
          }else{
            this.failPassword=false
          }

          if(err.response.data.errors.email){
            this.failEmail = true;
            this.failEmailMessage = err.response.data.errors.email[0]
          }else{
            this.failEmail = false;
          }
          if(err.response.data.errors.name){
            this.failName = true;
            this.failNameMessage = err.response.data.errors.name[0]
          }else{
            this.failName = false
          }

          if(err?.response?.data?.errors?.confirmed_password){
            this.failSecondPassword = true;
            this.failSecondPasswordMessage = err.response.data.errors.confirmed_password[0];
            console.log(err.response.data.errors.confirmed_password[0])
          }else{
            this.failSecondPassword = false;
          }
          this.errorExists = true;
          this.errorText = err.response.data.message
        }
      })
    },
    authUser(){
      axios.post('api/auth-user',this.authForm, {
        "Content-type":"application/json",
        'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }).then(res=>{
          window.location.href = "/"
      }).catch(err=>{
        console.log(err.response.data.message)

        if (err?.response?.data?.errors) {
          if(err.response.data.errors.login){
            this.failLogin = true;
            this.failLoginMessage = err.response.data.errors.login[0]
            console.log(this.failLoginMessage);
          }
          if(err.response.data.errors.password){

            this.failPassword = true;
            this.failPasswordMessage = err.response.data.errors.password[0]
          }

        }else if(err?.response?.data?.message){
          this.authFail = true;
          this.failAuthMessage = "Пользователь не найден"
        }

      });

    }
  }
}
</script>

<style scoped>
  form{
    width: 400px;
    margin: 40px auto;
    background-color: #f7f7f7;
    box-shadow: 0 2px 4px 0 darkgray;
    padding: 50px 30px;
  }

  .form-group{
    display: flex;
    flex-direction: column;
  }

  .form-group input{
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 0;
    border: 1px solid gray;
    outline: none;
    padding:5px 0 5px 5px;
  }

  a{
    color: #1a202c;
  }

  input[type='submit']{
    padding: 6px 20px;
    background: #303b44;
    color:white;
    border:none;
  }

  p{
    padding-bottom: 20px;
    font-size: 25px;
    text-align: center;
  }
  span{
    margin-bottom: 20px;
  }
</style>