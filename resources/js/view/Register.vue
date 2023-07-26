<template>

<div style="background-color:#fbf2ee;with:100%;height:100vh">

<div class="container mt-2 mb-5" >
        <div class="row justify-content-center">
            <div class="col-md-6 login col-sm-12 p-5">
                <p class="alert alert-danger" v-for='(error,i) in errors' :key="i"> 
                    <span  v-for='(err,j) in error' :key="j"> 
                    {{err}}
                    </span>
                    <!-- {{error}} -->
                </p>
                <div class="single_sidebar_wiget search_form_widget">
                    <form action="#">
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control my-3"
                                placeholder="enter your email"
                                v-model="Form.email"
                            
                            />
                            <input
                                type="text"
                                class="form-control my-3"
                                placeholder="enter your name"
                                v-model="Form.name"
                            
                            />
							<input
                                type="password"
                                class="form-control my-3"
                                placeholder="enter your password"
                                v-model="Form.password"

                           
                            />
                            <input
                                type="password"
                                class="form-control my-3"
                                placeholder="confirm password"
                                v-model="Form.c_password"

                             
                            />
                            <div @click="register" class="btn_1  pb-2" style="cursor: pointer;">Register</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </template>
    
     
<script setup>
import {reactive,ref } from 'vue'
import {useRouter } from 'vue-router'
import {useStore } from 'vuex'

     const store =useStore();
     const router =useRouter();
     const Form =reactive({
      name:'',
      email:'',
      password:'',
      c_password:''
    })
    const errors=ref([])
    const register = async ()=>{
      await axios.post('api/register',Form).then(res=>{
        if(res.data.success){
          console.log(res.data)
          store.dispatch('setToken',res.data.data.token)
        //   router.push({name:'home'})
        }else{
          console.log(res)
        errors.value=res.data.message
        }
      
    } ).catch(err=>{
        console.log(err)

       errors.value=err.response.data.message
    }) 
  }


</script>

    <style scoped>

    </style>
    