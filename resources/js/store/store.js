import {createStore} from 'vuex'
import axios from 'axios'
import Swal from 'sweetalert2'
import Message from './Message'

import {useRouter } from 'vue-router'
const router=useRouter()

const store=createStore({
    state: {
        posts:[],
        post:{},
        user:{},
        comments:[],
        mostCommented:[],
        usersActive:[],
        categories:[],
        user_id_auth:localStorage.getItem('user_id_auth') || 0,
        pages_count:1,
        page:1,
        success:'',
        token: localStorage.getItem('token') || null,
        auth:{},
        is_admin: localStorage.getItem('is_admin') || 0,
        message:'',
        is_login:false,
        headers:{
            'Content-Type':'application/json',
            'Autorization':'Bearer '+localStorage.getItem('token')
           },
       },
     
    mutations:{
  
        async FETCH_POSTS (state){
                try {
                    const res=await axios.get(`http://127.0.0.1:8000/api/posts`)
                      state.posts=res.data.posts.data
                      state.mostCommented=res.data.mostCommented
                      state.usersActive=res.data.usersActive
                      state.pages_count=res.data.pages_count
                      state.categories=res.data.categories
                      console.log('Headers')
                      console.log(state.headers)
                       } catch (error) {
                        Message(error.response.data.message,'error','red')
                }},
                async FETCH_POSTS_PROFILE (state,user_id=user_id_auth){
                    try {
                        const res=await axios.get(`http://127.0.0.1:8000/api/posts_profile/${user_id}`)
                          state.posts=res.data.posts.data
                          console.log('res.data ---------')
                          console.log(res.data.posts)
                           } catch (error) {
                            Message(error.response.data.message,'error','red')
                    }},
                async FETCH_ARCHIVE_POSTS (state,user_id){
                    try {
                        const res=await axios.get(`http://127.0.0.1:8000/api/fetch_archive/${user_id}`,{headers:state.headers})
                        // router.push({name:'home'})
                        state.posts=[]
                          state.posts=res.data.posts.data
                          
                          console.log('state.posts-------')
                          console.log(router)
                         
                           } catch (error) {
                          console.log(error)

                             Message(error.response.data.message,'error','red')
                    }},
          async getPostsByCategory(state,categoryId){

            try {
                state.page=1
                const res=await axios.get(`http://127.0.0.1:8000/api/getPostsByCategory/${categoryId}`)
                  state.posts=res.data.posts.data
                  
                } catch (error) {
                    Message(error.response.data.message,'error','red')
            }},
           async SEARCH_POST(state,search){
            try {
                const res=await axios.get(`http://127.0.0.1:8000/api/search/${search}`)
                  state.posts=res.data.posts.data
                   } catch (error) {
                    Message(error.response.data.message,'error','red')
                   }
            }, 
            async  GET_POST(state,postId){
                try {
                    const res=await axios.get(`http://127.0.0.1:8000/api/posts/${postId}`)
                      state.post=res.data.post[0]
                      
                      localStorage.setItem('post',JSON.stringify(state.post))
                       } catch (error) {
                        Message(error.response.data.message,'error','red')
                       }
          
            }, 
            async GET_COMMENTS_USERS_OF_POST(state,postId){
                try {
                    const res=await axios.get(`http://127.0.0.1:8000/api/comments_users/${postId}`)
                      state.comments=res.data.comments
                       } catch (error) {
                        Message(error.response.data.message,'error','red')
                       }
                }, 
                async ADD_COMMENT(state,payload){
                    try {
                       const res= await axios.post(`http://127.0.0.1:8000/api/comments`,{
                            post_id:payload.postId,
                            content:payload.comment_content,
                            user_id:parseInt(state.user_id_auth)
                             })
                       } catch (error) {
                        console.log('error.response')
                        console.log(error.response)
                       error.response.status==403 ? Message('you must be login please !!','error','red'):
                        Message(error.response.data.message,'error','red')
                        
                       }
                    }, 
                    async GET_USER(state,user_id_auth){
                        try {
                            const res=await axios.get(`http://127.0.0.1:8000/api/users/${user_id_auth}`)
                              state.user=res.data.user
                              console.log(' state.user')
                             
                   state.posts=state.posts.filter((p)=>p.user_id== route.params.id)
        
                               } catch (error) {
                               
                                 Message(error.response.data.message,'error','red')
                            }
                        },
                        UPATE_TOKEN(state,payload){
                            state.token=payload.token
                            state.is_admin=payload.is_admin
                            state.user_id_auth=payload.user_id_auth
                            state.auth=payload.auth
                        } ,
                        async IS_LOGIN(state){
                            try {
                                const res=await axios.post(`http://127.0.0.1:8000/api/is_login`)
                               
                                  console.log(' IS_LOGIN')
                                  console.log(res.data.is_login)
                                 
                                  state.is_login=res.data.is_login
            
                                   } catch (error) {
                                   
                                     Message(error.response.data.message,'error','red')
                                }
                        } ,
                      async  LOGOUT(state){
                        try{
                            await axios.post('http://127.0.0.1:8000/api/logout',{headers:state.headers})
                              localStorage.removeItem('token')
                              localStorage.removeItem('is_admin')
                              localStorage.removeItem('user_id_auth')
                  
                              store.state.token=null
                              store.state.user_id_auth=0
                              store.state.is_admin=0
                                                       
                          }catch(error){
                              console.log(error)
                              Message(error.response.data.message,'error','red')
                          } 
                        }

    },
    actions:{
        GET_POSTS({commit}){
            commit("FETCH_POSTS");
        },
        getPostsByCategory({commit},categoryId){
            // commit("FETCH_POSTS");
             commit('getPostsByCategory',categoryId)
        },
        SEARCH_POST ({commit},search){
            commit("SEARCH_POST",search);
        },
        GET_POST({commit},postId){
            commit("GET_POST",postId);
        }, 
        GET_COMMENTS_USERS_OF_POST({commit},postId){
            commit("GET_COMMENTS_USERS_OF_POST",postId);
        },
        ADD_COMMENT({commit},payload){
            commit("ADD_COMMENT",payload);
            commit("GET_COMMENTS_USERS_OF_POST",payload.postId);
        }, 
        GET_USER({commit},user_id_auth){
            commit("GET_USER",user_id_auth);
        }, 
        FETCH_ARCHIVE_POSTS({commit},user_id){
            commit("FETCH_ARCHIVE_POSTS",user_id);
        }, 
        FETCH_POSTS_PROFILE({commit},user_id){
            commit("FETCH_POSTS_PROFILE",user_id);
        }, 
        

        setToken(context,payload){
            localStorage.setItem('token',payload.token)
            localStorage.setItem('user_id_auth',payload.user_id_auth)
            localStorage.setItem('is_admin',payload.is_admin)
            context.commit('UPATE_TOKEN',payload)
           },
           removeToken(context){
            localStorage.removeItem('token');
            localStorage.removeItem('user_id_auth');
            localStorage.removeItem('is_admin');
            context.commit('UPATE_TOKEN',0)
           },
           IS_LOGIN(context){
            context.commit("IS_LOGIN");
           },
           LOGOUT(context){
            context.commit("LOGOUT");
           }
           
          
        },

     

})
export default store