<script setup lang="ts">
import PswdCard from "./PswdCard.vue";
</script>

<template>
  <div class="container mx-auto">
    <div class="text-3xl font-bold text-blue-400 text-center mt-20">
      Password Keeper
    </div>

    <!-- search bar -->
    <div class="flex justify-center mt-6 mb-4">
      <label class="input">
        <svg
          class="h-[1em] opacity-50"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
        >
          <g
            stroke-linejoin="round"
            stroke-linecap="round"
            stroke-width="2.5"
            fill="none"
            stroke="currentColor"
          >
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </g>
        </svg>
        <input type="search" required placeholder="Search" />
      </label>
    </div>

    <div class="flex justify-center mb-25">
      <button class="btn btn-info">ADD RECORD</button>
    </div>

    <!-- cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 w-max mx-auto gap-4">
      <PswdCard title="Instagram" login="tahaanz" password="password" />
      <PswdCard title="Facebook" login="tahaanz" password="password" />
      <PswdCard title="Google" login="tahaanz" password="password" />
    </div>
  </div>
</template>
