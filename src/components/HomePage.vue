<script setup lang="ts">
import { ref, onMounted } from 'vue';
import PswdCard from "./PswdCard.vue";
import passwordService from '../services/password';
import authService from '../services/auth';
import { useRouter } from 'vue-router';

const router = useRouter();
const passwords = ref([]);
const searchQuery = ref('');
const loading = ref(true);
const error = ref('');

// Filter passwords based on search query
const filteredPasswords = computed(() => {
  if (!searchQuery.value) return passwords.value;
  const query = searchQuery.value.toLowerCase();
  return passwords.value.filter(password => 
    password.title.toLowerCase().includes(query) || 
    password.login.toLowerCase().includes(query)
  );
});

// Load passwords from API
const loadPasswords = async () => {
  loading.value = true;
  try {
    const response = await passwordService.getAll();
    passwords.value = response.data;
  } catch (e) {
    console.error('Failed to load passwords', e);
    error.value = 'Failed to load passwords';
    if (e.response && e.response.status === 401) {
      // If unauthorized, redirect to login
      localStorage.removeItem('auth_token');
      router.push('/login');
    }
  } finally {
    loading.value = false;
  }
};

// Logout function
const logout = async () => {
  try {
    await authService.logout();
    localStorage.removeItem('auth_token');
    router.push('/login');
  } catch (e) {
    console.error('Logout failed', e);
  }
};

onMounted(() => {
  loadPasswords();
});
</script>

<template>
  <div class="container mx-auto">
    <div class="flex justify-between items-center mt-4 px-4">
      <div class="text-3xl font-bold text-blue-400">Password Keeper</div>
      <button @click="logout" class="btn btn-outline">Logout</button>
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
        <input v-model="searchQuery" type="search" placeholder="Search" />
      </label>
    </div>

    <div class="flex justify-center mb-6">
      <button class="btn btn-info">ADD RECORD</button>
    </div>

    <!-- Loading state -->
    <div v-if="loading" class="text-center my-8">
      <p>Loading passwords...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="text-center my-8 text-red-500">
      {{ error }}
    </div>

    <!-- Empty state -->
    <div v-else-if="filteredPasswords.length === 0" class="text-center my-8">
      <p v-if="searchQuery">No passwords match your search.</p>
      <p v-else>No passwords saved yet. Add your first password!</p>
    </div>

    <!-- Password cards -->
    <div v-else class="grid grid-cols-1 sm:grid-cols-2 w-max mx-auto gap-4">
      <PswdCard 
        v-for="password in filteredPasswords" 
        :key="password.id"
        :id="password.id"
        :title="password.title" 
        :login="password.login" 
        :password="password.password"
        @delete="loadPasswords"
        @update="loadPasswords"
      />
    </div>
  </div>
</template>
