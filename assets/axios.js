import axios from 'axios';

//  une instance Axios
const instance = axios.create({
  baseURL: 'https://127.0.0.1:8000/api/', // URL de base de votre API
  timeout: 1000, // Délai d'attente (en ms)
});

// Ajouter un interceptor pour les requêtes
instance.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }
  return config;
}, (error) => {
  return Promise.reject(error);
});

export default instance;
