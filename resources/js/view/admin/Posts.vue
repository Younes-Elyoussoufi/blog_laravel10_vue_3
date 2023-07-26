<template>
  
    <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Posts List</h5>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>content</th>
                        <th>date</th>
                        <th>Created by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <tr v-for="post in posts">
                        <td>
                          <img :src="'/site/img/post'+'/'+post.image" />
                        </td>
                        <td>{{post.title}}</td>
                        <td>{{post.content}}</td>
                        <td>{{post.created_at}}</td>
                        <td>
                           <router-link :to="{name:'profile',params:{id:post.user_id}}">
                                {{ post.user.name }}
                           </router-link>
                         </td>
                        <td class="d-flex justify-content-between align-items-center"> 
                          <router-link :to="{name:'editPost',params:{id:post.id}}" class=" btn-warning  btn-sm">
                              <i class="fas fa-edit"></i>
                           </router-link>
                    
                            <button @click="deletePost(post.id)" class=" btn-danger  btn-sm mx-2">
                                <i class="fas fa-trash"></i>
                            </button>
                           
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
                   <div class="page_pageniation d-flex justify-content-center" >
                        <nav aria-label="Page navigation example " >
                            <v-pagination
                                    v-model="page"
                                    :pages="pages_count"
                                    :range-size="1"
                                    active-color="#DCEDFF"
                                    @update:modelValue="fetchPostsPagination"
                                />
                        </nav>
                    </div> 
    </div>
                       
</div>

</div>
<!-- /.container-fluid -->
</template>
<script setup>
 import {useStore } from 'vuex'
 import {onMounted,computed,ref} from 'vue'
 import {useRoute} from 'vue-router'
 import Swal from 'sweetalert2'
 import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

const store=useStore()
const route=useRoute()
const posts = computed(()=>store.state.posts)
const page=ref(1)
const pages_count=computed(()=>store.state.pages_count)

const  fetchPostsPagination=async()=>{
    try {
    const res=await axios.get(`http://127.0.0.1:8000/api/posts?page=`+page.value)
        store.state.pages_count=res.data.pages_count
        store.state.posts=res.data.posts.data
          } catch (error) {
    console.log(error)
                }}

const fetchPosts=()=>{
store.dispatch('GET_POSTS')
  }

onMounted(() => { fetchPosts(); })

 async function deletePost(id){
  await  axios.delete('http://127.0.0.1:8000/api/posts/'+id)
    .then(function (response) {
      console.log(response.data.success)
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
      }
  ).catch(
      function (error) {
      console.log(error)
      }
  )
}
      

</script>