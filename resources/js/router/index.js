import { createRouter,createWebHistory,createMemoryHistory} from "vue-router";

import store from '../store/store.js'

import Home from '../view/Home.vue'
import Post from '../view/Post.vue'
import Public from '../view/Public.vue'
import Profile from '../view/Profile.vue'
import editProfile from '../view/editProfile.vue'
import NotFoundComponent from '../view/NotFoundComponent.vue'
import createPost from '../view/createPost.vue'
import Contact from '../view/Contact.vue'
import editPost from '../view/editPost.vue'


import Login from "../view/Login.vue";
import Register from "../view/Register.vue";

import Admin from '../view/admin/Admin.vue'
import Admin2 from '../view/admin/Admin2.vue'
import Users from '../view/admin/Users.vue'
import Posts from '../view/admin/Posts.vue'
import Statistics from '../view/admin/Statistics.vue'
import archiveAdmin from '../view/admin/archiveAdmin.vue'
import Category from '../view/admin/Category.vue'
import ArchiveUsers from '../view/admin/ArchiveUsers.vue'




const routes=[
    {
        path:'/',
        name:'public',
        component:Public,
        children:[
            {
                path:'/',
                name:'home',
                component:Home,
            },
            {
                path:'/post/:id',
                name:'post',
                component:Post 
            },
            {
                path:'/post/edit/:id',
                name:'editPost',
                component:editPost 
            },
            {
                path:'/contact',
                name:'contact',
                component:Contact 
            },
           
           
            {
                path:'/post/create',
                name:'createPost',
                component:createPost,
                meta:{
                    requiresAuth:true
                }
            },
            {
                path:'/profile/:id',
                name:'profile',
                component:Profile,
           
            },
            {
                path:'/profile/edit/:id',
                name:'editProfile',
                component:editProfile,
                meta:{
                    requiresAuth:true
                }
            },
            {
                path:'/login',
                name:'login',
                component:Login,
               
            },
            {
                path:'/register',
                name:'register',
                component:Register,
              
            },
        ]
    },
    {
        path:'/admin',
        name:'admin',
        component:Admin,
        meta:{
            AuthAdmin:true
        },
        children:[
            {
            path:'/admin',
            name:'statistics',
            component:Statistics,
            },
            {
                path:'/admin/users',
                name:'users',
                component:Users,
            },
            {
                path:'/admin/users_archive',
                name:'archiveUsers',
                component:ArchiveUsers,
            },
            {
                path:'/admin/posts',
                name:'posts',
                component:Posts,
            },
            {
                path:'/admin/posts_archive',
                name:'archiveAdmin',
                component:archiveAdmin,
            },
            {
                path:'/admin/category',
                name:'category',
                component:Category,
            },
            
            
        ]
    },
    { 
        path: '/:pathMatch(.*)', 
        component: NotFoundComponent 
    }
    
]
const router=createRouter({ 
    history:createWebHistory(),
    // history:createMemoryHistory(), 
    routes,
})
router.beforeEach( (to,from)=>{
    if(to.meta.requiresAuth && store.state.token==null){
        store.state.message='you must be login please !!'
        return {name:'login'}
    }
    
    if(to.meta.AuthAdmin && store.state.is_admin!=1 ){ 
        return {name:'home'}
    }
})
export default router