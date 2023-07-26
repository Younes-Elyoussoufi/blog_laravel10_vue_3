<template>

      <!--::header part start::-->
      <header class="main_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <router-link :to="{name:'home'}" class="navbar-brand" href="index.html"> <img src="img/logo.png" alt="logo"> </router-link>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <!-- <li class="nav-item">
                                    <router-link :to="{name:'home'}"  @click="fetch_archive" class="nav-link" >Archive</router-link >
                                </li> -->
                              
                               
                                <li class="nav-item" v-if="user_id_auth != 0">
                                    <a href="/" @click.prevent="fetch_archive(user_id_auth)" class="nav-link" >Archive</a>
                                </li>
                                <li class="nav-item">
                                    <router-link :to="{name:'contact'}" class="nav-link" >Contact</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link :to="{name:'createPost'}" class="nav-link" >Create</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link v-if="store.state.token !=null && store.state.is_admin==1" :to="{name:'admin'}" class="nav-link" >admin</router-link>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-user"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <li class="dropdown-item">
                                            <router-link v-if="store.state.token !=null" 
                                            @click="store.dispatch('FETCH_POSTS_PROFILE',user_id_auth)" 
                                            :to="{name:'profile',params:{id:user_id_auth}}" class="dropdown-item" >Profile</router-link >
                                        </li>
                                        <li v-if="store.state.token==null" class="dropdown-item">
                                            <router-link :to="{name:'login'}" class="dropdown-item" >Login</router-link >
                                        </li>
                                        <li v-if="store.state.token==null" class="dropdown-item">
                                            <router-link :to="{name:'register'}" class="dropdown-item" >Register</router-link >
                                        </li>
                                        <li v-if="store.state.token !=null" class="dropdown-item">
                                            <a href="#" @click.prevent="logout" class="dropdown-item" >Logout</a>
                                        </li>
                                    </div>
                                </li>
                            </ul>
                        </div>
                       
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

</template>
<script setup>
 import {useStore } from 'vuex'
import {onMounted,computed,} from 'vue'
import {useRoute,useRouter } from 'vue-router'


const store=useStore()
const route=useRoute()
const router=useRouter()

const categories = computed(()=>store.state.categories)
const user_id_auth = computed(()=>store.state.user_id_auth)
if (user_id_auth ==0) {
   router.push({name:'login'}) 
}
const getPostsByCategory=(categoryId)=>{ 
    store.dispatch('getPostsByCategory',categoryId) 
} 
const fetch_archive=(user_id)=>{ 

    store.dispatch('FETCH_ARCHIVE_POSTS',user_id) 
    router.push({name:'home'}) 
    store.dispatch('FETCH_ARCHIVE_POSTS',user_id) 
   } 

    const logout = async ()=>{
    store.dispatch('LOGOUT') 
    router.push({name:'home'}) 
      }

</script>
<style scoped>
/* .dropdown-item{
    padding: 2px !important;
} */


</style>
