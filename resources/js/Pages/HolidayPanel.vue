<template>
  <div class="flex flex-col justify-center items-center ">
    <div class="flex w-1/2 py-4 px-6 border rounded-lg shadow justify-between mb-4">
      <select v-model="selectedOption" id="selectBox" class="border rounded-lg p-2 mb-4 w-1/3" placeholder="Ülke Seçiniz">
        <option value="">Ülke Seçiniz</option>
        <option v-for="country in countries" :key="country.countryCode" :value="country.countryCode">{{ country.name }}</option>
      </select>
      <input type="text" v-model="inputText" id="textInput" class="border rounded-lg p-2 mb-4 w-1/3" placeholder="Yıl" required>
      <button @click="fetchHolidays" class="bg-purple-700 hover:bg-purple-500 text-white font-bold py-1 px-4 rounded w-1/5 h-10">GETİR</button>
    </div>
    <holiday-item v-if="holidays.length > 0" v-for="holiday in holidays" :key="holiday.countryCode" :value="holiday.countryCode" :holiday="holiday" class="my-2"/>
    <button v-if="holidays.length > 0" @click="saveCheckedHolidays" class="bg-purple-700 hover:bg-purple-500 text-white font-bold py-1 px-4 rounded w-1/5 h-10 mt-4">İÇERİ AKTAR</button>
    <spinner v-if="loading" />
    
  </div>

</template>
  
  <script>
  import axios from 'axios';
import HolidayItem from './HolidayItem.vue';
import Spinner from'./Spinner.vue';
  
  export default {
  components: { HolidayItem,Spinner },
    data() {
      return {
        selectedOption: '',
        inputText: '',
        countries: [],      
        holidays: [],
        checkedHolidays: [] ,
        loading: false

      };
    },
    created() {
      axios.get('https://date.nager.at/api/v3/AvailableCountries')
        .then(response => {
          this.countries = response.data;
        })
        .catch(error => {
          console.error('Error fetching countries:', error);
        });
    },
    methods: {
      fetchHolidays() {
      const url = `https://date.nager.at/api/v3/PublicHolidays/${this.inputText}/${this.selectedOption}`;
      axios.get(url)
        .then(response => {
          this.holidays = response.data.map(holiday => {
            return { ...holiday, checked: false };
          });
        })
        .catch(error => {
          console.error('Error fetching holidays:', error);
        });
    },
    handleCheckboxChange(holiday) {
      holiday.checked = !holiday.checked;
    },
    saveCheckedHolidays() {
      this.loading = true;
      this.checkedHolidays = [];
      this.holidays.forEach(holiday => {
        if (holiday.checked) {
          this.checkedHolidays.push(holiday);
        }
      });
      axios.post('/api/public-holidays', { checkedHolidays: this.checkedHolidays })
        .then(response => {
          console.log('holidays saved successfully:', response.data);
          this.holidays.forEach(holiday => {
            holiday.checked = false;
          });
          this.loading = false;
        })
        .catch(error => {
          console.error('Error saving checked holidays:', error);
        });
    }
  }
}
  </script>