import api from './api';

export default {
  getAll() {
    return api.get('/passwords');
  },
  
  get(id) {
    return api.get(`/passwords/${id}`);
  },
  
  create(data) {
    return api.post('/passwords', data);
  },
  
  update(id, data) {
    return api.put(`/passwords/${id}`, data);
  },
  
  delete(id) {
    return api.delete(`/passwords/${id}`);
  }
} 