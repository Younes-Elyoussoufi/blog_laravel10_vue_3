<template>
                    <div class="row" style="cursor: pointer">
                        <div  v-for="post in posts" :key="post.id" class="col-md-3 col-sm-6" >
                            
                            <div class="single_post post_1" >
                                <div  class="single_post_img">
                                    <router-link :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)" >
                                     <img :src="'site/img/post'+'/'+post.image" alt="">
                                    </router-link>
                                </div>
                                <!-- <div class="single_post_text text-center"> -->
                                    <div class="blog_details">
                                        <router-link  :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)">
                                            <h5>{{post.title.substr(0,30)}}...</h5>
                                        </router-link> 
                                        <router-link @click="GET_POST(post.id)" :to="{name:'post',params:{id:post.id}}">
                                            <p>{{post.content.substr(0,45)}}...</p>
                                        </router-link> 
                                 <p >
                                    {{post.published}} <strong> By </strong> 
                                    <router-link  @click="store.dispatch('FETCH_POSTS_PROFILE',post.user_id)" 
                                    :to="{name:'profile',params:{id:post.user_id}}" style="color:#fc4600">
                                        {{post.user.name}}
                                    </router-link>
                                </p>  
                                </div> 
                                
                                   
                            </div>
                        </div>
                        <hr>
                       
                    </div>
                    <div class="page_pageniation d-flex justify-content-center" >
                        <nav aria-label="Page navigation example " >
                            <v-pagination
                                    v-model="page"
                                    :pages="pages_count"
                                    :range-size="1"
                                    active-color="#DCEDFF"
                                    @update:modelValue="fetchPosts"
                                />
                        </nav>
                    </div>                                
               
</template>

<script setup>
import {ref,computed,onBeforeMount } from "vue";

import {useStore } from 'vuex'
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
const store=useStore()
// const page=ref(store.state.page)
const page=ref(1)
const pages_count=computed(()=>store.state.pages_count)

const props=defineProps({
    posts:{required:true,type:Array}
})


const  fetchPosts=async()=>{
    try {
    const res=await axios.get(`http://127.0.0.1:8000/api/posts?page=`+page.value)
        store.state.pages_count=res.data.pages_count
        store.state.posts=res.data.posts.data
          } catch (error) {
    console.log(error)
                }}
 function GET_POST(postId) {
    store.dispatch("GET_POST",postId);
    store.dispatch("GET_COMMENTS_USERS_OF_POST",postId);
    
}             

</script>

<style scoped>
.blog_details {
    padding: 2px 0 0 0 !important;
}
h5{
    font-style: oblique;
    font-family: inherit;
}
p{
    line-height: normal;
    margin-bottom: 14px !important;
}
</style>