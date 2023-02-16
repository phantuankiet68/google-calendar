<template>
    <div class="modal">
         <div class="modal__display">
 
         </div>
         <div class="modal__body">
             <div class="form__center">
               <h1>Create add event</h1>
               <span @click.prevent="closeModal"><i class='bx bx-message-alt-x' ></i></span>
             </div>
             <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
             <div class="modal__body__form">
                 <form action="" @submit.prevent="saveData()">
                     <div class="form__create">
                        <span for="">Title</span>
                        <input  v-model="form.title" type="text" >
                     </div>
                     <div class="form__create">
                        <span for="">bắt đầu</span>
                        <input class="form-control" v-model="form.start_date" type="datetime-local" />
                     </div>
                     <div class="form__create">
                        <span for="">kết thúc</span>
                        <input class="form-control" v-model="form.end_date" type="datetime-local" />
                     </div>
                      <div class="form__create">
                         <span for="">Color</span>
                         <select name=""  v-model="form.color" id="">
                            <option value="" selected disabled hidden>Color</option>
                            <option class="red-color" value=" #ff4d4d">red</option>
                            <option class="green-color" value="#33ff77">green</option>
                            <option class="Yellow-color" value="#ffff66">Yellow</option>
                            <option class="blue-color" value="#00bfff">blue</option>
                         </select>
                     </div>
                    
                      <div class="form__create">
                           <span for="">Thời gian</span>
                           <select v-model="form.choose">
                             <option disabled value="">Chọn thời gian</option>
                             <option value="Bận">Bận</option>
                             <option value="Rảnh">Rảnh</option>
                           </select>
                      </div>
                       <div class="form__create">
                           <span for="">Chế độ </span>
                           <select v-model="form.notify">
                             <option disabled value="">Chọn chế độ</option>
                             <option value="Công khai">Công khai</option>
                             <option value="Riêng tư">Riêng tư</option>
                           </select>
                       </div>
                       <div class="form__create">
                          <button @click="saveCalendar" class="create">Create</button>
                          <button class="edit" >Edit</button>
                          <button class="delete">Delete</button>
                       </div>
                 </form>
             </div>
         </div>
    </div>
 </template>
 <script>

      import flatpickr from "flatpickr";
      export default {
      name:"Modal",
 
      data() {
             return {
                 showModel:true,
                 form:{
                     title:'',
                     start_date:'',
                     end_date:'',
                     color:'',
                     choose:'',
                     notify:'',
                     user_id:'1',
                     category_id:'6'
                 },
                 errorList:'',
                 catagories:{},
                 users:[],
             };
            
         },
     mounted(){
         this.getEvents()
     }
      ,setup() {
         flatpickr("input[type=datetime-local]", {});
      },
      methods:{
         getEvents(){
             axios.get('/api/category')
                 .then(response =>{
                     this.events = response.data;
                     this.events = this.$route.params.id;
             })
       },
       resetModal(){
         this.form = {
             title:'',
             start_date:'',
             end_date:'',
             color:'',
             choose:'',
             notify:'',
             user_id:'1',
             category_id:'6'
             }
        },
       closeModal(){
          this.$emit('closeModal')
       },
       saveCalendar(){
                 var mythis = this;
                 axios.post('/api/event/create', this.form)
                 .then(response =>{
                     alert(response.data.message);
                     this.closeModal();
                     eventBus.$emit('refresCalendar')
                     this.getEvents();
 
                 })
                 .catch(function (error){
                     if(error.response){
                         if (error.response.status == 422) {
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