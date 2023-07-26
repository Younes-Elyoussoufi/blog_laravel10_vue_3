<template>
  
    <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Archive Users List</h5>
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
                            <button @click="force_delete(user.id)" class=" btn-danger  btn-sm mx-2">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button @click="restoreUser(user.id)" class=" btn-success  btn-sm">
                                Restore
                            </button>
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
 import {onBeforeMount,ref,} from 'vue'
 import Swal from 'sweetalert2'

const users = ref([])

onBeforeMount(async() => {

await axios.get(`http://127.0.0.1:8000/api/users_archive`)
.then(function (response) {
    users.value=response.data.users
  }
).catch(
  function (error) {
  console.log(error)
  }
)

})

async function restoreUser(id){
            await  axios.get('http://127.0.0.1:8000/api/users/restore/'+id)
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
            await  axios.get('http://127.0.0.1:8000/api/users/force_delete/'+id)
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