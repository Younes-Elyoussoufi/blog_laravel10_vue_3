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
                                    type="password"
                                    class="form-control my-3"
                                    placeholder="enter your password"
                                    v-model="Form.password"
    
                               
                                />
                              
                                <div @click="login" class="btn_1  pb-2" style="cursor: pointer;">Login</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </template>
        
         
    <script setup>
    import Message from '../store/Message';

    import {reactive,ref,computed,onBeforeMount } from 'vue'
    import {useRouter } from 'vue-router'
    import {useStore } from 'vuex'
    
         const store =useStore();
         const router =useRouter();
         const Form =reactive({
          email:'ynesprince@gmail.com',
          password:'123456789',
        })
        const errors=ref([])
        const login = async ()=>{
          await axios.post('api/login',Form).then(res=>{
            console.log(res.data.user)
            store.state.auth=res.data.user

            if(res.data.success){
              console.log(res.data)
                store.dispatch('setToken',{
                token:res.data.token,
                is_admin:res.data.user.is_admin,
                user_id_auth:res.data.user.id,
                auth:res.data.user
            })
            router.push({name:'home'})
            console.log(res.data)
            }else{
            errors.value=res.data.message
            }
          
        } ).catch(err=>{
            console.log(err)
           errors.value=err.response.data.message
        }) 
      }
    
       const message =ref(store.state.message) 
   
        if (message.value!='') {
        Message(message.value,'error','red')
        setInterval(()=>{
             store.state.message=''
        },3000)
      }

    </script>
    
        <style scoped>
       
        </style>
        