
<template>
    <div id="app">
    
        <!-- <Admin /> -->
   
        <NavBar />
          <router-view></router-view>
        <Footer />
  
      </div>
    
  </template>
  <script setup>
//   import Admin from './view/admin/Admin.vue'
  import NavBar from '@/components/NavBar.vue'
  import Footer from '@/components/Footer.vue'
  
  </script>
  <style scoped>
  .logo {
    height: 6em;
    padding: 1.5em;
    will-change: filter;
    transition: filter 300ms;
  }
  .logo:hover {
    filter: drop-shadow(0 0 2em #646cffaa);
  }
  .logo.vue:hover {
    filter: drop-shadow(0 0 2em #42b883aa);
  }
  </style>
  