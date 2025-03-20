<template>
  <div class="border border-gray-300 rounded-xl p-6 w-[300px]">
    <div class="border-b border-gray-300 font-semibold">{{ title }}</div>

    <!-- login + password -->
    <div class="mt-6 flex flex-col space-y-2 text-gray-700">
      <div>
        <div>Login</div>
        <div class="border border-gray-200 rounded-lg p-2">{{ login }}</div>
      </div>

      <div class="flex justify-between border border-gray-200 rounded-lg p-2">
        <div>{{ password }}</div>
        <div><FontAwesomeIcon :icon="faHouse" /></div>
      </div>
    </div>

    <div class="flex justify-end space-x-2 mt-6 text-sm">
      <div class="btn btn-error">Delete</div>
      <div class="btn btn-success">Update</div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  login: String,
  password: String,
});
</script>
