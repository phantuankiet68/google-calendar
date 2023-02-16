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
            <sidebar/>
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
        <nav>
			<i class='bx bx-menu' ></i>
            <router-link to="/home" class="exit-controll"><i class='bx bx-left-arrow-alt'></i></router-link>
			<form action="#">
				<div class="form-input">
					<input type="search" v-model="searchQuery"  placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<a  class="notification">
                <router-link to="/home/search" ><i class='bx bx-search'></i></router-link>
			</a>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="notification">
				<i class='bx bx-help-circle'></i>
			</a>
			<a href="#" class="notification">
				<i class='bx bx-cog' ></i>
			</a>
			<a href="#" class="profile">
				<img src="../home/image/avata.jpg">
			</a>
		</nav>
		<main>
            <div class="container-body">
                <div class="main-body">
                    <div class="container-main">

                        <div class="searchbox">
                        </div>
                        <div class="postup">
                            <table>
                                <thead>
                                <tr>
                                    <th scope="col" width="50px">ID</th>
                                    <th class="none" scope="col" width="120px">Title</th>
                                    <th scope="col" width="80px">Start_date</th>
                                    <th class="none" scope="col" width="120px">end_date</th>
                                    <th scope="col" width="120px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(event,index) in this.events" :key="index">
                                    <td  data-label="Account">{{ event.id }}
                                    </td>
                                    <td class="none" data-label="Amount">{{ event.title }}</td>
                                    <td data-label="Period">{{ event.start_date}} </td>
                                    <td data-label="Period">{{ event.end_date}}</td>
                                    <td class="">
                                        <button class="btn-edit" type="button" data-id="2" data-address="Sample Address" data-name="Men Apparel"  data-contact="65524556">Edit</button>
                                        <button class="btn-delete" type="button" data-id="2">Delete</button>
                                    </td>
                                </tr>
                        
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>    
		</main>
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
                searchQuery:null
                
            };
           
        },
        watch:{
            searchQuery(after, before){
                this.getResult();
            }
        },
        mounted(){
            this.getEvent();
        },
        methods:{
             /**
             * Search event
             * @author KietPT
             */
            getResult(){
                axios.get('/api/home/search',{params:{search: this.searchQuery}})
               .then(response =>{
                    console.log(response)
                    this.events = response.data;
                })
                
            },
             /**
             * dateClick handle when click date
             * @author KietPT
             */
            getEvent(){
                axios.get('/api/home/search')
               .then(response =>{
                    console.log(response)
                    this.events = response.data;
                })
            },
            
        }
    }
</script>
