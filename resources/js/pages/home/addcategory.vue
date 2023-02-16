<template>
    <div class="main-body">
           <div class="container-main">
               <div class="title">
                  <router-link to="/home">
                       <span ><i class='bx bx-left-arrow-alt' ></i></span>
                  </router-link>
                  <span class="text">Settings</span>
               </div>
               <div class="searchbox">
                <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
               </div>
               <main id="view-panel" >
                   <div class="container-fluid">
                       <div class="col-lg-12">
                           <div class="row">
                               <!-- FORM Panel -->
                               <div class="col-md-4">
                               <form action="" id="manage-supplier">
                                   <div class="card">
                                       <div class="card-header">
                                               Thêm danh mục
                                       </div>
                                       <div class="card-body">
                                               <input type="hidden" name="id">
                                               <div class="form-group">
                                                   <label class="control-label">Tên Danh mục</label>
                                                   <input type="text" class="form-control" name="name" v-model="form.name">
                                               </div>
                                               <div class="form-group">
                                                   <label class="control-label">Mô tả danh mục</label>
                                                   <textarea name="address" id="address" v-model="form.desc" cols="30" rows="4" class="form-control"></textarea>
                                               </div>
                                               <div class="form-group">
                                                   <label class="control-label" >Color</label>
                                                   <select name=""  v-model="form.color" id="">
                                                       <option value="" selected disabled hidden>Color</option>
                                                       <option class="red-color" value=" #ff4d4d">
                                                            red
                                                       </option>
                                                       <option class="green-color" value="#33ff77">green</option>
                                                       <option class="blue-color" value="#00bfff">blue</option>
                                                   </select>
                                               </div>
                                       </div>
                                               
                                       <div class="card-footer">
                                           <div class="row">
                                               <div class="col-md-12">
                                                   <button class="btn-save" @click="savecategory" > Save</button>
                                                   <button class="btn-cancel" type="button" onclick="$('#manage-supplier').get(0).reset()"> Cancel</button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </form>
                               </div>
                               <!-- FORM Panel -->
                   
                               <!-- Table Panel -->
                               <div class="col-md-8">
                                       <div class="card">
                                           <div class="card-header">
                                               <b>Danh sách danh mục</b>
                                           </div>
                                           <div class="card-body">
                                            <span class="card-body-title">
                                                General
                                            </span>
                                            <ul class="side-menu top">
                                                <h4>Setting for my calendars</h4>
                                                <li >
                                                    <a href="#">
                                                        <span class="text">Create new calendar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="text">From URL</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="text">
                                                            <router-link to="/home/category/list" >List</router-link>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="side-menu top">
                                                <h4>Setting for my calendars</h4>
                                                <li  v-for="category in this.categories" :key="category.id">
                                                    <a href="#">
                                                        <i class='bx  red'></i>
                                                        <span class="text">{{ category.name }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="side-menu top footer-menu" >
                                                <h4>Setting for my calendars</h4>
                                                <li >
                                                    <a href="#">
                                                        <i class='bx yellow'></i>
                                                        <span class="text">Dashboard</span>
                                                    </a>
                                                </li>
                                            </ul>
                                           </div>
                                       </div>
                                   </div>
                   
                               <!-- Table Panel -->
                           </div>
                       </div>  
                   
                   </div>
               </main>
           </div>
   </div>
</template>
<script >

   import { useRouter } from 'vue-router';
 
   const router = useRouter()
   export default{
       name:'categoryCreate',
       data(){
           return {
               categories:[],
               errorList:'',
               categoryId:'',
               form:{
                   id:'',
                   name:'',
                   desc:'',
                   color:''
               }
           }
       },
       mounted(){
           this.getCategory()
       }
       ,
       methods:{
            /**
             * Get data category
             * @author KietPT
             */
           getCategory(){
               axios.get('/api/category')
               .then(response =>{
                    this.categories = response.data
               })
           },
            /**
             * save data category
             * @author KietPT
             */
           savecategory(){
                var mythis = this;
                axios.post('/api/category/create', this.form)
                .then(response =>{
                    console.log(response.data)
                    alert(response.data.message);
                    this.form = {
                        name: "",
                        desc: "",
                        color: ""
                    }

                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status === 422) {
                            mythis.errorList = error.response.data.errors;
                        }
                        else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    }
                })
            },
          
           
       }

   }
</script>