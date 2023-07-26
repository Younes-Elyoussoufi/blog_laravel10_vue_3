<template>
  
    <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Users List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>name</th>
                        <th>email</th>
                        <th>date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <tr v-for="user in users">
                        <td>
                          <img :src="'/site/img/user'+'/'+user.avatar" height="100" width="100"/>
                        </td>
                        <td>
                            <router-link :to="{name:'profile',params:{id:user.id}}">
                                    {{ user.name }}
                            </router-link>
                        </td>
                        <td>{{user.email}}</td>
                        <td>{{user.created_at}}</td>
                      
                           
                        <td> 
                            <button @click="deleteUser(user.id)" class=" btn-danger  btn-sm mx-2">
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
                                    @update:modelValue="fetchUsersPagination"
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
 import {onBeforeMount,ref,computed} from 'vue'
 import Swal from 'sweetalert2'
 import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

const store=useStore()

const page=ref(1)
const users = ref([])
const pages_count=computed(()=>store.state.pages_count)

onBeforeMount(async() => { 
    try {
        const res=await axios.get(`http://127.0.0.1:8000/api/users`)
          console.log('res.data.users')
          console.log(res.data.pages_count)
            users.value=res.data.users.data
           } catch (error) {
           console.log(error)
    }})

    const  fetchUsersPagination=async()=>{
            try {
               const res=await axios.get(`http://127.0.0.1:8000/api/users?page=`+page.value)
                store.state.pages_count=res.data.pages_count
                users.value=res.data.users.data
                } catch (error) {
                console.log(error)
                }
        }
 
    async function deleteUser(id){
            await  axios.delete('http://127.0.0.1:8000/api/users/'+id)
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