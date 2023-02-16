<template>
        <div class="main-body">
               <div class="container-main">
                   <div class="title">
                       <router-link to="/home">
                           <span ><i class='bx bx-left-arrow-alt' ></i></span>
                       </router-link>
                       <span class="text">Settings</span>
                   </div>
                </div>
        </div>
		<!-- MAIN -->
            <div class="main__content">
            <section class="about section" id="about">
                <div class="about_container">
                    <cropper
                        class="cropper"
                        :src="img"
                        :stencil-props="{
                        aspectRatio: 10/12
                        }"
                        @change="change"
                    ></cropper>
                    <div class="card_wrapper">
                        
                        <div class="wrapper_left">
                            <div class="card">
                                <p>Name</p>
                                <input type="text" class="input" v-model="form.name"/>

                                <p>Email</p>
                                <input type="email" class="input" v-model="form.email"/>

                                <p>Username</p>
                                <input type="text" class="input" v-model="form.username"/>
        
                                <p>Description</p>
                                <textarea cols="10" rows="5" v-model="form.desc" ></textarea>
                                    
                            </div>
                        </div>
                        
                        <div class="wrapper_right ">
                            <div class="card">
                                <div class="avatar_profile">
                                 <img :src="form.image" alt="" class="avatar_profile_img">
                                </div>
                                <input type="file"   v-on:change="onImageChange"  />   
                            </div>  
                        </div>
                        
                    </div>
                    <div class="titlebar">
                        <div class="titlebar_item">
                            
                        </div>
                        <div class="titlebar_item">
                            <div @click.prevent="updateAbout" class="btn btn-secondary">
                                Save Changes
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
            </div>

</template>

<script >
    import { Cropper } from 'vue-advanced-cropper'
    import 'vue-advanced-cropper/dist/style.css';
   export default{
      name:'AboutHome',
      data(){
          return {
              form:{
                name: '',
                username:'',
                email:'',
                image: '',
                desc:'',
              },
              img: ''
          }
          
      },
      components:{
          Cropper
       },
      
       mounted(){
 
       },
       methods:{
              /**
             * Get data category && error
             * @author KietPT
             */
             change({coordinates, canvas}) {
                this.form.image =  canvas.toDateURL()
                console.log(coordinates, canvas)
            },
            
             onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form.image = e.target.result;
                    vm.img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/image/store',{image: this.form.image,}).then(response => {
                   console.log(response);
                });
            },

       }
    }


</script>