<template>
    
<div class="row" style="background-color:#fbf2ee;with:100%;height:100vh">
    <div class="col-md-6 m-auto p-3">
 <form @submit="formSubmit" enctype="multipart/form-data">
    <h2 class="text-center">Add Post</h2>
   <div class="form-group">
    <textarea class="form-control" v-model="post.title"  placeholder="Title" rows="1"></textarea>
  </div>
 
  <div class="form-group">
    <select class="form-control" v-model="post.category_id">
      <option>choose category</option>
      <option v-for="(category) in categories" :value="category.id"  >{{category.name}}</option>
 
    </select>
  </div>

  <div class="form-group">
     <input type="file"  @change="onChangeFile" class="form-control" > 
  </div> 

  <div class="form-group">
    <textarea class="form-control" v-model="post.content" placeholder="Content" rows="3"></textarea>
  </div>
  <div class="load_btn mb-5" >
       <button class="btn_1" type="submit" >SUBMIT </button>
    </div>
</form>
    </div>
</div>
</template>

<script setup>
import { useStore } from "vuex";
import { reactive,computed,onBeforeMount } from "vue";
import { useRoute,useRouter } from "vue-router";
import Swal from 'sweetalert2'
const store = useStore();
const route = useRoute();
const router = useRouter();

const categories=computed( ()=> store.state.categories)

const getPost=store.state.posts.find(p=> p.id==route.params.id)

console.log(getPost.title )
const post= reactive({
    title:getPost.title,
    content:getPost.content,
    category_id:getPost.category_id,
    image:getPost.image,
})
console.log('POSST' )
console.log(post.content)


  const onChangeFile=(e)=>{
    post.image=e.target.files[0]
    console.log('------'+post.value)
}

async function formSubmit(e){
  console.log('sumbit')
      e.preventDefault();
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
      }
  console.log('oooooooo', post.content)
      let formData = new FormData();
      formData.append("_method", "put");
      formData.append('id', route.params.id);
      formData.append('image', post.image);
      formData.append('title', post.title);
      formData.append('content', post.content);
      formData.append('category_id', post.category_id);

    await  axios.post('http://127.0.0.1:8000/api/posts/'+route.params.id, formData, config)
    .then(function (response) {
      console.log(response.data.success)
      console.log(formData)
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
                     setInterval( ()=>{router.push({name:'posts'})},3000 )
      }
  ).catch(
      function (error) {
      console.log(error)
      }
  )
      
}

           
                       
    
   
</script>

<style scopedv>
ul li {
    cursor: pointer;
}
.cat {
    margin: -15px !important;
}
.col-md-6{
    margin-top: 0px !important;
}
.load_btn{
    border:1px solid #fc4600 !important
}
</style>
