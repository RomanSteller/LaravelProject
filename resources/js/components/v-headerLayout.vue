<template>

    <div class="header">
      <div class="container header_container">
        <div class="header_logo">
          <img src="storage/logo/logo.png" alt="LOGO">
        </div>

        <div class="header_user_nickname">
          <div class="header_search">
            <input type="text">
          </div>
          <h2>Steellsey</h2>
        </div>
      </div>
    </div>

</template>

<script>
export default {
  name: "header"
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
}

.header_search input{
  outline: none;
  border: none;
  padding: 5px 20px;
}

</style>