<template>
  <div class="flex flex-col justify-center items-center">
    <holiday-saved-item v-for="holiday in holidayData" :key="holiday.id" :holiday="holiday" @fetch-holidays="fetchHolidays"/>
  </div>  


</template>
<script>
import axios from 'axios';
import HolidaySavedItem from './HolidaySavedItem.vue';

export default {
  components: { HolidaySavedItem },
  data() {
    return {
      holidayData: []
    };
  },
  methods: {
    fetchHolidays() {
      
      axios.get('/api/public-holidays')
        .then(response => {
          this.holidayData = response.data;
        })
        .catch(error => {
          console.error('Error fetching holidays:', error);
        });
    },
  },
  created() {
    this.fetchHolidays();
  },
};
</script>
