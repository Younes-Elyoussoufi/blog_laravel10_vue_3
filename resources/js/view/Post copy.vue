<template>

                            <!-- <div class="single_post post_1 feature_post">
                                <div class="single_post_img">
                                    <img src="img/post/post_12.png" alt="">
                                </div>
                                <div class="single_post_text text-center">
                                    <a href="category.html"><h5> {{post.title}}</h5></a> 
                                    <a href="single-blog.html"><h2>{{post.content}}</h2></a> 
                                    <p>Posted on April 15, 2019</p><p >{{post.published}} <strong>By</strong>  /<span style="color:#fc4600">{{post.user.name}}</span></p>
                                </div> -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area all_post section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" :src="'/site/img/post'+'/'+post.image" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>
                        {{ post.title }}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="far fa-user"></i> BY <span class="text-primary">{{ post.user.name }}</span></a></li>
                        <li><a href="#"><i class="far fa-comments"></i> {{post.comments_count}} Comments</a></li>
                     </ul>
                
                     <p>
                        {{ post.content }}   
                     </p>
                    
                  
                  </div>
               </div>
              
              
               <div class="comments-area">
                  <h4>{{post.comments_count}} Comments</h4>
                
                  
                              <Comments :postId="post.id" />
                     
                  
               </div>
               <div class="comment-form" style="margin-top: 0 !important;">

                  <form class="form-contact comment_form" action="#" id="commentForm">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea v-model="comment" class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                       
                     </div>
                     <div class="load_btn mb-5" >
                        <button class="btn_1" @click.prevent="ADD_COMMENT(post.id)">SUBMIT </button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
                  <div class="sidebar_widget">
                        
                     <div class="single_sidebar_wiget">
                            <div class="sidebar_tittle">
                                <h3>Popular Posts  </h3>
                            </div>
                          
                            <div v-for="post in mostCommented" :key="post.id" class="single_catagory_post post_2 ">
                                <div class="category_post_img">
                                    <img src="site/img/sidebar/sidebar_1.png" alt="">
                                </div>
                                <div class="post_text_1 pr_30">
                                    <a href="single-blog.html">
                                        <h3>{{post.title.substr(0,30)}}...</h3>
                                    </a>
                                    <p >
                                        <span class="mx-1"> By {{post.user.name}}</span> / {{post.published}} 
                                        <span class="badge badge-success text-white">
                                            ({{post.comments_count}}) Comments 
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
import { computed,ref } from "vue";

const comment=ref('')
components:{Comments}

const post=computed( ()=> store.state.post)
const mostCommented =computed(()=>store.state.mostCommented)

const store = useStore();

function ADD_COMMENT(postId){
   store.dispatch('ADD_COMMENT',{postId,comment_content:comment.value})
   comment.value=''
}

</script>

<style scoped>
textarea{
   border: 2px solid black !important;
}
</style>
