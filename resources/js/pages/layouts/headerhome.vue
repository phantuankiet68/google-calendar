<template>
    <!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					
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
				<router-link to="/home/about" ><img src="../home/image/avata.jpg"></router-link>
			</a>
		</nav>
		<!-- NAVBAR -->
</template>