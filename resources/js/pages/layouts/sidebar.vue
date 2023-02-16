<template>
		<div class="datehome">
            <Datepicker  @dateClick="dateClick" inline auto-apply />
		</div>
	<!-- SIDEBAR -->
</template>

<script>
     import {ref} from 'vue'
    import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
    export default {
        components:{
            Datepicker
        },
		
        setup() {
			const date = ref(new Date());
			
			return {
				date,
			}
		},
		methods:{
			dateClick(arg){
                console.log('fulltime',arg)
            },
		}
    }
</script>