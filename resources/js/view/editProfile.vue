<template>
    
<div class="row" style="background-color:#fbf2ee;with:100%;height:100vh">
    <div class="col-md-6 m-auto p-3">
 <form @submit="formSubmit" enctype="multipart/form-data">
    <h2 class="text-center">Update Profile</h2>
   <div class="form-group">
    <textarea class="form-control" v-model="user.name"  placeholder="name" rows="1"></textarea>
  </div>
  <div class="form-group">
    <textarea class="form-control" v-model="user.country"  placeholder="country" rows="1"></textarea>
  </div>
 
  
  <div class="form-group">
     <input type="file"  @change="onChangeFile" class="form-control" > 
  </div> 
  <img :src="'/site/img/user'+'/'+user.avatar" height="100" width="100"/>
  
  <div class="form-group">
    <textarea class="form-control" v-model="user.about" placeholder="about me" rows="3"></textarea>
  </div>
  <div class="load_btn mb-5" >
       <button class="btn_1" type="submit" >SUBMIT </button>
    </div>
</form>
    </div>
</div>
</template>

<script setup>
import Message from '../store/Message'

import { useStore } from "vuex";
import { reactive,computed,onMounted,onBeforeMount } from "vue";
import { useRoute,useRouter } from "vue-router";
import Swal from 'sweetalert2'
const store = useStore();
const route = useRoute();
const router = useRouter();


const getUser=store.state.user

const user= reactive({
    name:getUser.name,
    country:getUser.country,
    about:getUser.about,
    avatar:getUser.avatar,
})
var avatar=null
  const onChangeFile=(e)=>{
    avatar=e.target.files[0]
    console.log('2222 '+avatar)
}

async function formSubmit(e){
  console.log('sumbit')
      e.preventDefault();
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append("_method", "put");
      formData.append('id', route.params.id);
      formData.append('name', user.name);
      formData.append('about', user.about);
      formData.append('country', user.country);
      formData.append('avatar',avatar);

    await  axios.post('http://127.0.0.1:8000/api/users/'+route.params.id, formData, config)
    .then(function (response) {
      console.log(response.data.success)
      console.log(response.data.img)
                  //   message response
                      const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                          })
                        
                        Toast.fire({
                          icon: 'success',
                          title: response.data.success
                        })
                    // end message response 
                    // store.state.user=response.data.user
                   // setInterval( ()=>{router.push({name:'profile',params:{id:route.params.id}})},3000 )
                   router.go(-1)
      }
  ).catch(
      function (error) {
      console.log(error)
      Message(error.response.data.message,'error','red')

      }
  )
      
}

           
                       
    
   
</script>

<style scopedv>
ul li {
    cursor: pointer;
}
.cat {
    margin: -15px !important;
}
.col-md-6{
    margin-top: 0px !important;
}
.load_btn{
    border:1px solid #fc4600 !important
}
</style>
