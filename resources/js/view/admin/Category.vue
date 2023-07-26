<template>
  
    <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-end">
        
            <div class="mt-10">
                <input type="text" v-model="category_name" placeholder="add new category" 
                
                    required class="single-input bg-white">
            </div>
            <div class="mt-10">
                   <button @click="addCategory()" class="genric-btn primary">Add category</button>
            </div>
    
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Category name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                    <tr v-for="category in categories">
                        
                        <td style="font-weight:bolder">{{category.name}}</td>

                       
                        <td class="d-flex justify-content-center"> 
                    
                            <button @click="deleteCategory(category.id)" class=" btn-danger  btn-sm mx-2">
                                <i class="fas fa-trash"></i>
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
 import {onMounted,computed,ref} from 'vue'
 import Swal from 'sweetalert2'

   const category_name=ref("")
   const store=useStore()
   const categories = computed(()=>store.state.categories)

   async function deleteCategory(id){
  await  axios.delete('http://127.0.0.1:8000/api/category/'+id)
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


async function addCategory(){
  await  axios.post('http://127.0.0.1:8000/api/category/',{name:category_name.value},{headers:store.state.headers})
    .then(function (response) {
                       const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)}})
                         Toast.fire({
                          icon: 'success',
                          title: response.data.success
                        })
                        console.log(response.data)
      }
  ).catch(
      function (error) {
        console.log(error.response.data.message)
        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 4000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)}})
                         Toast.fire({
                          icon: 'error',
                          title: error.response.data.message
                        })
      }
  )
}

</script>