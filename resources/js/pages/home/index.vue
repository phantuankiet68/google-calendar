<template>
    <section id="sidebar">
		<a href="#" class="brand">
			<img src="../home/image/logo.png">
			<span class="text">Lịch</span>
		</a>
		<div class="create">
			<div href="" class="create_choose" >
				<svg width="36" height="36" viewBox="0 0 36 36"><path fill="#34A853" d="M16 16v14h4V20z"></path><path fill="#4285F4" d="M30 16H20l-4 4h14z"></path><path fill="#FBBC05" d="M6 16v4h10l4-4z"></path><path fill="#EA4335" d="M20 16V6h-4v14z"></path><path fill="none" d="M0 0h36v36H0z"></path></svg>
			    <span class="create_text">Create</span>
			</div>
			<div class="sub_create-wrap" id="subMenu">
				<div class="sub_create">
				    <a href="" class="sub_create-link">
				    	<i class='bx bxs-calendar-event' ></i>
				        <p>Sự kiện</p>
				    </a>
				    <a href="" class="sub_create-link">
				    	<i class='bx bx-list-ol'></i>
				        <p>
							<router-link to="/home/category" >Việc cần làm</router-link>
						</p>
				    </a>
			    </div>
			</div>
		</div>
		<div class="datehome">
            <sidebar />
		</div>
		<ul class="side-menu top">
			<li v-for="category in this.categories" :key="category.id">
				<a >
					<i class='bx  red'></i>
					<span class="text">{{ category.name }}</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- CONTENT -->
	<section id="content">
        <HeaderHome/>
		<!-- MAIN -->
		<main>
            <calendar @dateClick="dateClick"/>
		</main>
		<!-- MAIN -->
        <ModelCalendar v-if="showModel"  @closeModal="closeModal"/>
	</section>

</template>

<script >
     
    import sidebar from '../layouts/sidebar.vue';
    import HeaderHome from '../layouts/headerhome.vue'
    import calendar from './calendar.vue';
    import ModelCalendar from '../home/calendarModel.vue';
    export default{
        components:{
            sidebar,HeaderHome,calendar,ModelCalendar
        },
        data() {
            return {
                categories:[],
                events:[],
                showModel:false,

            };
           
        },
        mounted(){
            this.getEvent();
        },
        methods:{
            getEvent(){
                axios.get('/api/home')
               .then(response =>{
                  this.events = response.data.events
                  this.categories = response.data.categories
                })
            },
            /**
             * dateClick handle when click date
             * @author KietPT
             */

            dateClick(arg){
                this.$data.showModel = true
            },
            closeModal(arg){
                this.$data.showModel = false;
                console.log(arg)
            },
            
        }
    }
</script>