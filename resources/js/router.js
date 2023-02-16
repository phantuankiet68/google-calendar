import {createRouter, createWebHistory} from 'vue-router'

//pages
import HomePage from './pages/home/index.vue'
//pages
import HomeSearch from './pages/home/searchEvent.vue'
//Category
import HomeCategory from './pages/home/addcategory.vue'
//List Category
import ListCategory from './pages/home/listcategory.vue'
//Edit Category ID
import HomeAbout from './pages/home/about.vue'
//Edit Category ID
import EditCategoryID from './pages/home/editcategory.vue'
//error
import Error from './pages/home/error.vue'
//login
import Login from './auth/login.vue'


const routes = [
     //login
     {
      path: '/',
      component: Login,
      name:'Login',
      meta:{
         requiresAuth:false
      }
     },
     //page
     {
        path:'/home',
        name: 'Home',
        component:HomePage,
        meta:{
            requiresAuth:false
        }
     },
       //page
       {
         path:'/home/search',
         name: 'SearchHome',
         component:HomeSearch,
         meta:{
             requiresAuth:false
         }
      },
       //about
     {
      path:'/home/about',
      name: 'HomeAbout',
      component:HomeAbout,
      meta:{
          requiresAuth:false
      }
   },
     //Category
     {
      path: '/home/category',
      name: 'categoryHome',
      component: HomeCategory,
      meta:{
          requiresAuth:true
      }

    },
    //Category
    {
      path: '/home/category/list',
      name: 'categoryList',
      component: ListCategory,
      meta:{
          requiresAuth:true
      }

    },
   //Edit Category ID
   { 
      path: '/home/category/edit/:id',
      name: 'EditCategoryId',
      component: EditCategoryID,
      meta:{
         requiresAuth:true
      }
 
   },
     //Error
     {
        path:'/:pathMatch(.*)*',
        name: 'Error',
        component:Error,
        meta:{
         requiresAuth:false
        }
     }
]






const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from)=>{
   if(to.meta.requiresAuth && !localStorage.getItem('token')){
      return { name: 'Login' }
   }
})

export default router