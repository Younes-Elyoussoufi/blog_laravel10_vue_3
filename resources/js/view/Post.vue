<template>
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area all_post section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" :src="'/site/img/post'+'/'+post.image" style="width: 100% !important; height: 400px !important;">
                  </div>
                  <div class="blog_details">
                     <h2>
                        {{ post.title }}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li>
                           <!-- <router-link @click="GET_POST(post.id)" :to="{name:'post',params:{id:post.id}}"> -->
                                <i class="far fa-user"></i> BY 
                                <router-link style="color: #0056b3 !important;" 
                                :to="{name:'profile',params:{id:post.user_id}}" 
                                class="user mx-1">
                                 <!-- <span class="text-primary">{{ post.user.name }}</span>-->

                                        </router-link> 
                      
                        </li>
                        <li><a href="#"><i class="far fa-comments"></i> {{post.comments_count}} Comments</a></li>
                     </ul>
                
                     <p>
                        {{ post.content }}   
                     </p>
                    
                  
                  </div>
               </div>
              
              
           
                              <Comments :post="post" />
                     
                  
              
            </div>
            <div class="col-lg-4">
                  <div class="sidebar_widget">
                        
                     <div class="single_sidebar_wiget">
                            <div class="sidebar_tittle">
                                <h3>Popular Posts  </h3>
                            </div>
                          
                            <div v-for="post in mostCommented" :key="post.id" class="single_catagory_post post_2  "  width="100" height="100">
                              <router-link  :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)">
                                <div class="category_post_img" >
                                    <img  :src="'/site/img/post'+'/'+post.image" alt=""  height="120" width="200">
                                </div>
                              </router-link> 
                                <div class="post_text_1 pr_30">
                                 <router-link :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)">
                                        <h3>{{post.title.substr(0,30)}}...</h3>
                                 </router-link> 
                                    <p > By
                                       <router-link
                                        @click="store.dispatch('FETCH_POSTS_PROFILE',post.user_id)" 
                                        :to="{name:'profile',params:{id:post.user_id}}" class="user mx-1"> 
                                          {{post.user.name}}
                                       </router-link> / {{post.published}} 
                                        <span class="badge badge-success text-white">
                                            ({{post.comments_count}}) Comments 
                                        </span> 
                                    </p>
                                </div>
                            </div>
                           
                     </div>
                      <!-- users active  -->
                      <div class="single_sidebar_wiget">
                            <div class="sidebar_tittle">
                                <h3>Users Active</h3>
                            </div>
                          
                            <div v-for="user in usersActive" :key="user.id" class="single_catagory_post post_2 ">
                                    <img :src="'/site/img/user'+'/'+user.avatar" 
                                    style="height: 70px !important; width: 70px !important; border-radius: 50%;">
    
                                    <div class="post_text_1 pr_30">
                                       <router-link :to="{name:'profile',params:{id:user.id}}" style="color:#fc4600">
                                        {{user.name}}
                                    </router-link>
                                    <p >
                                        <span class="badge badge-success text-white">
                                            ({{user.posts_count}}) Posts 
                                        </span> 
                                    </p>
                                </div>
                            </div>
                           
                         </div>
                        
                        <div class="single_sidebar_wiget">
                              <div class="sidebar_tittle">
                              <h3>Share this post</h3>
                              </div>
                              <div class="social_share_icon tags">
                              <ul class="list-unstyled">
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                    <li><a href="#"><i class="ti-pinterest"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                              </ul>
                              </div>
                        </div>
                  </div>
            </div>
         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->

</template>

<script setup>
import Comments from './Comments.vue'
import { useStore } from "vuex";
import { ref,computed,onMounted,onBeforeMount} from "vue";
import {  useRoute, useRouter } from "vue-router";

const route = useRoute();
const store = useStore();
components:{Comments}

const mostCommented =computed(()=>store.state.mostCommented)
const usersActive =computed(()=>store.state.usersActive)

const post=computed(()=>store.state.post)

function GET_POST(postId) {
    store.dispatch("GET_POST",postId);
    store.dispatch("GET_COMMENTS_USERS_OF_POST",postId);
} 
store.dispatch("GET_POST",route.params.id);
onBeforeMount(() => {
    store.dispatch("GET_POST",route.params.id);
    store.dispatch('GET_POSTS')
    
    console.log('mounted')
})

console.log('xxxxxxxxxxxx')

console.log(store.state.post)

</script>

<style scoped>
textarea{
   border: 2px solid black !important;
}
.user{
    color: #0056b3 !important;
 }
</style>
