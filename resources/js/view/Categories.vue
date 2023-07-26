<template>
<div class="single_sidebar_wiget ">
                            <div class="sidebar_tittle cat">
                                <h3>Categories</h3>
                            </div>
                            <div class="single_catagory_item category">
                                <ul class="list-unstyled">
                                    <li @click="getPostsByCategory(category.id)" v-for="category in categories" :key="category.id">
                                        <a >
                                        {{category.name}}
                                        </a> 
                                        <span>({{category.posts_count}})</span> 
                                    </li>
                                 </ul>
                            </div>
                        </div>
</template>

<script setup>
import {useStore } from 'vuex'
const store=useStore()

const props=defineProps({
    categories:{required:true,type:Array}
})
const getPostsByCategory=(categoryId)=>{ 
    store.dispatch('getPostsByCategory',categoryId) 
}           


</script>

<style scopedv>
   ul li{
    cursor: pointer;
   }
   .cat{
    margin: -15px !important;
  }
</style>