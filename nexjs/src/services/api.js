import axios from  'axios'

export const baseURL = 'http://localhost:8000/api/v1/';

const api = axios.create({
  baseURL: baseURL
})

export default api