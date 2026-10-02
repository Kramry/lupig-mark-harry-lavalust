import axios from 'axios';

const API_URL = process.env.REACT_APP_API_URL || 'http://localhost/LavaLust-dev-v4/public';

const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export const authAPI = {
  login: (username, password) =>
    api.post('/api/auth/login', { username, password }),
  verify: () => api.get('/api/auth/verify'),
};

export const productAPI = {
  getAll: () => api.get('/api/products'),
  getById: (id) => api.get(`/api/products/${id}`),
  create: (data) => api.post('/api/products', data),
  update: (id, data) => api.post(`/api/products/${id}`, data),
  delete: (id) => api.get(`/api/products/${id}/delete`),
};

export default api;
