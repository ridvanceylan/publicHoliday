<template>
    <!-- Display Holiday Information -->
    <div class="flex w-1/2 py-4 px-6 border rounded-lg shadow justify-between items-center my-2">
      <div class="flex items-center">
        <div>
          <span class="block text-sm text-gray-600">{{ formattedDate }}</span>
          <span class="block font-bold text-lg">{{ holiday ? holiday.name : '' }}</span>
        </div>
      </div>
      <button @click="openModal()" class="outline-gray-400 outline hover:bg-gray-300 text-gray-500 font-bold py-1 px-4 rounded w-1/10 h-10">Düzenle</button>
    </div>
    <!-- Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen">
        <!-- Modal overlay -->
        <div class="fixed inset-0 bg-black opacity-25"></div>
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-xl max-w-lg p-6">
          <!-- Datepicker -->
          <label for="datepicker" class="block mb-2 font-bold text-gray-700"> Date</label>
          <VueDatePicker v-model="selectedDate" :enable-time-picker="false"></VueDatePicker>

          <!-- Name input -->
          <label for="name" class="block mb-2 font-bold text-gray-700">Title:</label>
          <input v-model="holidayName" id="name" type="text" class="w-full px-4 py-2 border rounded-lg mb-4" placeholder="name">

          <label class="block mb-2 font-bold text-gray-700" for="note">Note:</label>
          <textarea id="note" v-model="note" class="w-full px-4 py-2 border rounded-lg mb-4"></textarea>

          <!-- Save button -->
          <button @click="saveHoliday" class="bg-purple-700 hover:bg-purple-500 text-white font-bold py-1 px-4 rounded w-full h-10">Kaydet</button>

          <!-- Close button -->
          <button @click="closeModal" class="absolute top-0 right-0 mt-4 mr-4 text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


export default {
  props: {
    holiday: null
  },
  data() {
    return {
      isModalOpen: false,
      selectedDate: '',
      holidayData: {
        date: '',
        name: '',
        note: ''
      },
    };
  },
  methods: {
    ParentFetchHolidays() {
      this.$emit('fetch-holidays');
    },
    openModal() {
      // Open the modal
      this.isModalOpen = true;
    this.selectedDate = this.holiday.date;
    this.holidayName = this.holiday.name || '';
    this.note = this.note || '';
  
    },
    closeModal() {
      this.isModalOpen = false;
    },
    saveHoliday() {
  

      const updatedHoliday = {
        name: this.holidayName,
        date: this.selectedDate,
        note: this.note
      };

      axios.put(`/api/public-holidays/${this.holiday.id}`, updatedHoliday)
        .then(response => {
          console.log(`/api/public-holidays/${this.holiday.id}`, response.data);
          this.closeModal();
          this.ParentFetchHolidays();
        })
        .catch(error => {
          console.error('Error updating holiday:', error);
        });
      }

  },
  components: {
    VueDatePicker
  },
  computed: {
    formattedDate() {
      const dateString = this.holiday.date;
      const dateObject = new Date(dateString);

      const day = dateObject.getDate();
      const monthIndex = dateObject.getMonth();
      const year = dateObject.getFullYear();

      const months = [
        "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
        "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"
      ];
   
      const dayIndex = dateObject.getDay();
      const days = ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"];

      const formattedDate = `${day} ${months[monthIndex]} ${year}, ${days[dayIndex]}`;
      return formattedDate;
    }
  }
};
</script>
