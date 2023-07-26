<template>
    <div class="row  px-4">
        <div class="col-md-12 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 position-relative"  >
                    <img class='coverI ' :src="'/site/img/user'+'/'+user.cover" />

                    <div class="media align-items-end profile-head avatar ">
                        <div class="profile mr-3">
                              <img :src="'/site/img/user'+'/'+user.avatar" height="100" width="100"/>
                              <a
                                href="#"
                                
                                ></a>
                                <router-link v-if="store.state.token !=null && user.id==user_id_auth" :to="{name:'editProfile',params:{id:route.params.id }}" class="btn_1 btn-sm d-block ">
                                    Update
                                </router-link>
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-3 mb-0">{{user.name}}</h4>
                            <p class="small mb-4">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ user.country || '' }}
                            </p>
                        </div>
                
                
                    </div>
                   
                </div>
                <div
                    class="bg-light p-4 d-flex justify-content-end text-center"
                >
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">215</h5>
                            <small class="text-muted">
                                <i class="fas fa-image mr-1"></i>Photos</small
                            >
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">745</h5>
                            <small class="text-muted">
                                <i class="fas fa-user mr-1"></i>Followers</small
                            >
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">340</h5>
                            <small class="text-muted">
                                <i class="fas fa-user mr-1"></i>Following</small
                            >
                        </li>
                    </ul>
                </div>
                <div class="px-4 py-3">
                    <h5 class="mb-0">About Me</h5>
                    <div class="p-4 rounded shadow-sm bg-light">
                        <p class="font-italic mb-0">
                            {{ user.about || '' }}
                        </p>
                        
                        
                    </div>
                </div>
                <div class="py-4 px-4">
                    <div
                        class="d-flex align-items-center justify-content-between mb-3"
                    >
                        <h5 class="mb-0">Recent Posts</h5>
                    </div>
                    <div class="row">
                        <div  v-for="post in posts" :key="post.id" class="col-md-3 col-sm-6" >
                            
                            <div class="single_post post_1" >
                                <div  class="single_post_img">
                                    <router-link :to="{name:'post',params:{id:post.id}}"
                                          @click="GET_POST(post.id)" >
                                     <img :src="'/site/img/post'+'/'+post.image" alt="">
                                    </router-link>
                                </div>
                                <!-- <div class="single_post_text text-center"> -->
                                    <div class="blog_details">
                                        <router-link @click="GET_POST(post.id)" :to="{name:'post',params:{id:post.id}}">
                                            <h5>{{post.title.substr(0,30)}}...</h5>
                                        </router-link> 
                                        <router-link @click="GET_POST(post.id)" :to="{name:'post',params:{id:post.id}}">
                                            <p>{{post.content.substr(0,45)}}...</p>
                                        </router-link> 
                                 <p >
                                    {{post.published}} <strong> By </strong> 
                                    <router-link :to="{name:'profile',params:{id:post.user_id}}" style="color:#fc4600">{{post.user.name}}</router-link>
                                </p>  
                                </div> 
                                
                                   
                            </div>
                        </div>

                    </div>
                    <div v-if="store.state.posts.length >10" class="page_pageniation">
                        <nav aria-label="Page navigation example">
                            <v-pagination
                                    v-model="store.state.page"
                                    :pages="pages_count"
                                    :range-size="1"
                                    active-color="#DCEDFF"
                                    @update:modelValue="fetchPosts"
                                />
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
 import {useStore} from 'vuex'
 import {useRoute} from 'vue-router'
 import {onBeforeMount,onMounted,computed,ref} from 'vue'
 const store = useStore()
 const route = useRoute()

 import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
const page=ref(1)
const pages_count=computed(()=>store.state.pages_count)
  
    let posts=computed(()=>store.state.posts.filter((p)=>p.user_id== route.params.id))

//  console.log('posts user' +posts.value)

function GET_POST(postId) {
    store.dispatch("GET_POST",postId);
     } 
const  fetchPosts=async()=>{
    try {
    const res=await axios.get(`http://127.0.0.1:8000/api/posts?page=`+page.value)
        store.state.pages_count=res.data.pages_count
        store.state.posts=res.data.posts.data
        // store.state.posts=res.data.posts.data.filter((p)=>p.user_id== route.params.id)
          } catch (error) {
    console.log(error)
                }

           }
          

 const user_id_auth=computed(()=>store.state.user_id_auth) 
 const user_id=route.params.id

 onBeforeMount(() => {
    store.dispatch('GET_USER',user_id) 
    store.dispatch('FETCH_POSTS_PROFILE',user_id) 
    
    //  store.dispatch("GET_POST");
    
    // fetchPosts()
 })

 const user=computed(()=>store.state.user)
//   let posts=computed(()=>store.state.posts)
console.log('< useeeer >')
console.log(store.state.posts)
console.log('< useeeer >')


</script>

<style scoped>
.profile-head {
    transform: translateY(5rem);
}

.cover {
    background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
    background-size: cover;
    background-repeat: no-repeat;
}

body {
    background: #654ea3;
    background: linear-gradient(to right, #e96443, #904e95);
    min-height: 100vh;
    overflow-x: hidden;
}
img.coverI {
    overflow: hidden;
    height: 400px;
    width: 100%;
    }
  .avatar {
    margin-top: -84px;
}
.btn_1 {
    width: 100px !important;
    text-align: center;
    padding: 0;
    border-radius: 0;
    padding: 5px;
}
</style>
