
<template>
  <div id="app">

        <router-view></router-view>

    </div>
  
</template>
<script setup>

   import {useStore } from 'vuex'
   import {onMounted,computed,} from 'vue'

   const store=useStore()
   
// onMounted(() => { 

//         store.dispatch('IS_LOGIN')
//         if (!store.state.is_login) {
//           store.dispatch('removeToken')
//         }

//       })
 
</script>
