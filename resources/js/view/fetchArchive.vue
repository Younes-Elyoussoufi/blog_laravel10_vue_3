<template>
  
  <!-- feature_post start-->
  <section class="all_post section_padding">
      <div class="container">
          <div class="row">
              <div class="col-lg-9">
                <h3>Archive Posts  </h3>
                <Posts :posts="posts"/>
              </div>
              <div class="col-lg-3">
                  <div class="sidebar_widget">
                      
                      <Search />
                  
                      <Categories :categories="categories"/>
                      
                       <div class="single_sidebar_wiget">
                          <div class="sidebar_tittle">
                              <h3>Popular Posts home </h3>
                          </div>
                        
                          <div v-for="post in mostCommented"  :key="post.id" class="single_catagory_post post_2 ">
                          <router-link :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)" >                           
                               <div class="category_post_img">
                                  <img :src="'site/img/post'+'/'+post.image" alt="" height="80" width="80">
                              </div>
                          </router-link>
                              <div class="post_text_1 pr_30">
                                  <router-link :to="{name:'post',params:{id:post.id}}" @click="GET_POST(post.id)">
                                 
                                      <h3>{{post.title.substr(0,30)}}...</h3>
                                 
                                 </router-link>
                                  <p >
                                      <span class="mx-1"> By {{post.user.name}}</span> / {{post.published}} 
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

                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- feature_post end-->

  <!-- social_connect_part part start-->
  <section class="social_connect_part">
      <div class="container-fluid">
          <div class="row">
              <div class="col-xl-12">
                  <div class="social_connect">
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_1.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_2.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_3.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_4.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_5.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
                  <div class="single-social_connect">
                      <div class="social_connect_img">
                          <img src="img/insta/instagram_6.png" class="" alt="blog">
                          <div class="social_connect_overlay">
                              <a href="#"><span class="ti-instagram"></span></a> 
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
      </div>
  </section>
  <!-- social_connect_part part end-->

</template>

<script setup>
 import Categories from './Categories.vue'
 import Posts from './Posts.vue'
 import Search from './Search.vue'
 import {useStore } from 'vuex'
 import {onMounted,computed,} from 'vue'

 const store=useStore()
 const posts = computed(()=>store.state.posts)
 const categories = computed(()=>store.state.categories)
 const mostCommented =computed(()=>store.state.mostCommented)
 const usersActive =computed(()=>store.state.usersActive)
 
 components:{Categories,Posts,Search}

       const fetchPosts=()=>{
        store.dispatch('GET_POSTS')

         }
         function GET_POST(postId) {
              store.dispatch("GET_POST",postId);
              store.dispatch("GET_COMMENTS_USERS_OF_POST",postId);
          }  

onMounted(() => { fetchPosts(); })

</script>

<style scoped>

</style>