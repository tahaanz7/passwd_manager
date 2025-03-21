<template>
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
      <h1 class="text-2xl font-bold text-center text-blue-400">Login</h1>
      
      <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ error }}
      </div>
      
      <form @submit.prevent="login" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input 
            v-model="form.email" 
            type="email" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
            required
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input 
            v-model="form.password" 
            type="password" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
            required
          />
        </div>
        
        <div>
          <button 
            type="submit" 
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            :disabled="loading"
          >
            {{ loading ? 'Logging in...' : 'Login' }}
          </button>
        </div>
      </form>
      
      <div class="text-center">
        <router-link to="/register" class="text-sm text-blue-500 hover:text-blue-600">
          Don't have an account? Register
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import authService from '../services/auth';

const router = useRouter();
const error = ref('');
const loading = ref(false);
const form = reactive({
  email: '',
  password: ''
});

const login = async () => {
  loading.value = true;
  error.value = '';
  
  try {
    const response = await authService.login(form);
    localStorage.setItem('auth_token', response.data.token);
    router.push('/');
  } catch (e) {
    if (e.response && e.response.data) {
      error.value = e.response.data.message || 'Failed to login';
    } else {
      error.value = 'An error occurred during login';
    }
  } finally {
    loading.value = false;
  }
};
</script> 