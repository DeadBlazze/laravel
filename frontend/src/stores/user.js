import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: () => ({
      role: ''
    }), 
    getters: {
        isAdmin: (state) => state.role === 'admin'
    },
    actions: {
      setUserRole(role) {
        this.role = role;
      },
      unsetRole() {
        this.role = '';
      }
    }
  });