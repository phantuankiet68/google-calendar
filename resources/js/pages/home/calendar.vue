<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGrid from '@fullcalendar/timegrid'
export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ interactionPlugin,dayGridPlugin,timeGrid ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'today,prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        dateClick: this.handleDateClick,
        addingMode: true,
      },
    }
  },
  beforeMount(){
     this.$data.calendarOptions.events = [
        {
          title: 'BCH237',
          start: '2019-08-12T10:30:00',
          end: '2019-08-12T11:30:00',
        }
      ]
     },
  mounted(){
    this.getEvent();
  },
  methods:{
      /**
        * click calender
        * @author KietPT
      */
      handleDateClick(clickInfo){
        this.$emit('dateClick', clickInfo)
      },
      getEvent(){
          axios.get('/api/home')
            .then(response =>{
              this.events = response.data.events
              this.categories = response.data.categories
          })
      },
      /**
        * Show calender
        * @author KietPT
      */
      showEvent(arg) {
        this.addingMode = false;
        const { id, title, start, end } = this.events.find(
          event => event.id === +arg.event.id
        );
        this.indexToUpdate = id;
        this.newEvent = {
          event_name: title,
          start_date: start,
          end_date: end
        };
      },
  }
}
</script>
<template>
  <FullCalendar @eventClick="showEvent" :options="calendarOptions" :events="events"/>
</template>