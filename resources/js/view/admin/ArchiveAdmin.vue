<template>
  
  <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Archive Posts List</h5>
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
                        <img :src="'/site/img/post'+'/'+post.image" width="70" height="70" />
                      </td>
                      <td>{{post.title}}</td>
                      <td>{{post.content}}</td>
                      <td>{{post.created_at}}</td>
                      <td>
                         <!-- <router-link :to="{name:'profile',params:{id:post.id}}">
                              {{ post.user.name }}
                         </router-link> -->
                       </td>
                     
                      <td class="d-flex justify-content-between "> 
                             <button @click="restorePost(post.id)" class=" btn-success  btn-sm">
                                Restore
                            </button>
                            <button  @click="force_delete(post.id)" class=" btn-danger  btn-sm mx-2">
                                delete definitivly
                            </button >
                        </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
</template>
<script setup>
import {useStore } from 'vuex'
import {onBeforeMount,onMounted,computed,ref} from 'vue'
import Swal from 'sweetalert2'

 const store=useStore()
 const posts = ref([])


 onBeforeMount(async() => {

  await axios.get(`http://127.0.0.1:8000/api/posts_archive`)
  .then(function (response) {
    posts.value=response.data.posts.data
    console.log('trashed')
    console.log(response.data.posts.data)
    }
).catch(
    function (error) {
    console.log(error)
    }
)
 
}) 
   

async function restorePost(id){
            await  axios.get('http://127.0.0.1:8000/api/post/restore/'+id)
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
                        }
                    ).catch(
                        function (error) {
                        console.log(error)
                        }
                    )
            } 
            
            async function force_delete(id){
            await  axios.get('http://127.0.0.1:8000/api/post/force_delete/'+id)
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
                        }
                    ).catch(
                        function (error) {
                        console.log(error)
                        }
                    )
            } 
 

</script>