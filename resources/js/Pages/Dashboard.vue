<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HolidayPanel from'./HolidayPanel.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <div>
      <!-- Navigation -->
      <nav class="bg-gray-200">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-center">     
              <div class="hidden sm:ml-6 sm:block">
                <div class="flex space-x-4">
                  <!-- First link -->
                  <a href="#" @click="activateLink(1)" :class="{ 'bg-gray-400': activeLink === 1 }" class=" text-black-300  hover:bg-gray-300 rounded-md  px-3 py-2 text-sm font-medium">Aktarım</a>
                  <!-- Second link -->
                  <a href="#" @click="activateLink(2)" :class="{ 'bg-gray-400': activeLink === 2 }" class="text-black-300 hover:bg-gray-300  rounded-md px-3 py-2 text-sm font-medium">Takvim</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
  
      <!-- Display HolidayPanel if the first link is active -->
      <div v-if="activeLink === 1">
        <holiday-panel class="p-5"/>
      </div>
  
      <!-- Display HolidaySaved if the second link is active -->
      <div v-if="activeLink === 2">
        <holiday-saved class="p-5"/>
      </div>
    </div>
  </template>
<script>
import HolidayPanel from './HolidayPanel.vue';
import HolidaySaved from './HolidaySaved.vue';

export default {
  components: {
    HolidayPanel,
    HolidaySaved
  },
  data() {
    return {
      activeLink: 1 // Initially set the first link as active
    };
  },
  methods: {
    activateLink(linkNumber) {
      this.activeLink = linkNumber;
    }
  }
};
</script>