<template>
       <main>
           <div class="main-body">
               <div class="container-main">
                   <div class="title">
                       <router-link to="/home/category">
                           <span ><i class='bx bx-left-arrow-alt' ></i></span>
                       </router-link>
                       <span class="text">Settings</span>
                   </div>
                   <div class="searchbox">
                       <ul  v-if="Object.keys(this.errorList).length > 0">
                           <li style="color: red;" v-for="(error, index) in this.errorList" :key="index">{{ error[0] }}</li>
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
                                                           <option class="red-color" value=" #ff4d4d"></option>
                                                           <option class="green-color" value="#33ff77"></option>
                                                           <option class="Yellow-color" value="#ffff66"></option>
                                                           <option class="blue-color" value="#00bfff"></option>
                                                       </select>
                                                   </div>
                                           </div>
                                                   
                                           <div class="card-footer">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <button class="btn-save" @click="updateCategory">Update</button>
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
                                                   <table class="table table-bordered ">
                                                       <thead>
                                                           <tr>
                                                               <th class="text-center">Stt</th>
                                                               <th class="text-center">Mô tả</th>
                                                               <th class="text-center">Chức năng</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                           
                                                           <tr v-for="(category,index) in this.category" :key="index">
                                                               <td style= "color: #707070;" class="text-center">{{ category.id }}</td>
                                                               <td class="">
                                                                   <p>Name: <b>{{ category.name }}</b></p>
                                                                   <p><small>Desc: <b>{{ category.desc }}</b></small></p>
                                                                   <p><small>Color: <b>{{ category.color }}</b></small></p>
                                                               </td>
                                                               <td class="text-center">
                                                                   <router-link :to="{ path: '/admin/category/'+category.id+'/edit'}" class="btn-edit" >Edit</router-link>
                                                                   <button class="btn-delete" @click="deletecategory(category.id)"  type="button" data-id="2">Delete</button>
                                                               </td>
                                                           </tr>
                                                           
                                                       </tbody>
                                                   </table>
                                                   <div class="container-pagination">
                                                       <div class="pagination">
                                                           <a href="#">&laquo;</a>
                                                           <a href="#">1</a>
                                                           <a class="actived" href="#">2</a>
                                                           <a href="#">3</a>
                                                           <a href="#">4</a>
                                                           <a href="#">5</a>
                                                           <a href="#">6</a>
                                                           <a href="#">7</a>
                                                           <a href="#">&raquo;</a>
                                                       </div>
                                               </div>
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
       </main>
</template>

<script >


  import { useRouter } from 'vue-router';

  const router = useRouter()
  export default{
      name:'EditCategoryId',
      data(){
          return {
              category:[],
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
      components:{
       },
      
       mounted(){
           this.categoryId = this.$route.params.id;
           this.getCategoryData(this.$route.params.id)
       },
       methods:{
              /**
             * Get data category && error
             * @author KietPT
             */
           getCategoryData(categoryId){
               var edit = '/api/category/edit/' + this.categoryId
               axios.get(edit).then(response =>{
                   console.log(response.data.category);
                   this.form = response.data.category
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           alert(error.response.data.message);
                       }
                   }
               })
           },
           /**
             * Update data category && error
             * @author KietPT
             */
           updateCategory(){
               var mythis = this;
               var edit = '/api/category/edit/' + this.categoryId;
               axios.put(edit, this.form)
               .then(response =>{
                   console.log(response.data)
                   alert(response.data.message);
                   this.form = {
                       name: "",
                       desc: "",
                       color:"",
                   }
                   router.push('/home')
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           mythis.errorList = error.response.data.errors;
                       }
                       else if (error.request) {
                           console.log(error.request);
                       } else {
                           console.log('Error', error.message);
                       }
                   }
               })
           }
       }

  }
</script>