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
        <div>{{ showPassword ? password : '••••••••' }}</div>
        <div>
          <button @click="togglePassword" class="text-blue-500">
            <font-awesome-icon :icon="showPassword ? 'eye-slash' : 'eye'" />
          </button>
        </div>
      </div>
    </div>

    <div class="flex justify-end space-x-2 mt-6 text-sm">
      <button @click="deletePassword" class="btn btn-error" :disabled="isDeleting">Delete</button>
      <button @click="updatePassword" class="btn btn-success">Update</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';
import passwordService from '../services/password';

const props = defineProps({
  id: Number,
  title: String,
  login: String,
  password: String,
});

const emit = defineEmits(['delete', 'update']);

const showPassword = ref(false);
const isDeleting = ref(false);

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

const deletePassword = async () => {
  if (confirm(`Are you sure you want to delete ${props.title}?`)) {
    isDeleting.value = true;
    try {
      await passwordService.delete(props.id);
      emit('delete');
    } catch (error) {
      console.error('Failed to delete password', error);
      alert('Failed to delete password');
    } finally {
      isDeleting.value = false;
    }
  }
};

const updatePassword = () => {
  // This could open a modal for updating the password
  // For simplicity, we'll just emit an event for now
  emit('update');
};
</script>
