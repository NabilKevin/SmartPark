// axiosClient.js
import axios from 'axios';

const base = import.meta.env.VITE_API_BASE
const prefix = import.meta.env.VITE_API_PREFIX

const axiosClient = axios.create({
  baseURL: `${base}${prefix}`,
  headers: {
    'Content-Type': 'application/json',
  },
});

export default axiosClient;
