<template>
   <div class="single_sidebar_wiget search_form_widget ">
         <form action="#" class="search">
            <div class="form-group">
                  <input type="text" class="form-control" v-model="search" placeholder='Search Keyword'
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                            <div class="btn_1" @click="SearchPost">search</div>
            </div>
        </form>
   </div>
</template>

<script setup>
 import {ref} from 'vue'
 import {useStore} from 'vuex'

 const store=useStore()
 const search=ref("")

 const SearchPost=()=>{
   store.dispatch('SEARCH_POST',search.value)
 }
</script>

<style scoped>
.search{
    margin: -16px !important;
}
.btn_1{
    cursor: pointer;
}
</style>