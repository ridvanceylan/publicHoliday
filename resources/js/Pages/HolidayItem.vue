<template>
      <div class="flex w-1/2 py-4 px-6 border rounded-lg shadow justify-between items-center">
        <!-- Checkbox Container -->
        <div class="flex items-center">
          <div>
            <span class="block text-sm text-gray-600">{{ formattedDate }}</span>
            <span class="block font-bold text-lg">{{ holiday.localName }}</span>
          </div>
        </div>
        <input type="checkbox" v-model="holiday.checked" @change="handleCheckboxChange" class="form-checkbox h-6 w-6 mr-2 ">
      </div>
  </template>
<script>
export default {
  props: {
    holiday:{},
  },
  data() {
    return {
      isChecked: false 
    };
  },
  methods: {
    handleCheckboxChange() {
      this.$emit('checkbox-change', this.holiday);
   }
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