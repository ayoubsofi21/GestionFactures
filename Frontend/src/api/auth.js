// src/api/auth.js
import axios from "axios";

const API_URL = "http://localhost:8000/api";

const api = axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
  },
});

// Add request interceptor to include token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default {
  login: (username, password) => api.post("/login", {username, password}),
  logout: () => api.post("/logout"),

  // Factures
  getFactures: () => api.get("/factures"),
  createFacture: (data) => api.post("/factures", data),
  autoriserFacture: (id) => api.post(`/factures/${id}/autoriser`),
  honorerFacture: (id) => api.post(`/factures/${id}/honorer`),

  // Fournisseurs
  getFournisseurs: () => api.get("/fournisseurs"),
  createFournisseur: (data) => api.post("/fournisseurs", data),

  // Marches
  getMarches: () => api.get("/marches"),
  createMarche: (data) => api.post("/marches", data),
};
