<template lang="pug">
    header.header 
            nav 
                ul
                    li 
                        router-link(to="/") Курсы
                    li
                        router-link(:to="headerLink")
                            template(v-if="isAdmin") Панель администратора
                            template(v-else) Личный кабинет
</template>
<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
const router = useRouter()
const userRole = ref(localStorage.getItem('userRole') || 'user'); // Начальное значение роли
const isLoggedIn = ref(localStorage.getItem('token') ? true : false);

const isAdmin = computed(() => userRole.value === 'admin');

const headerLink = computed(() => {
    if (isLoggedIn.value) {
        return isAdmin.value ? '/admin' : '/user-cabinet';
    } else {
        return '/login';
    }
})

const setUserRole = (newRole) => { // Сеттер
    userRole.value = newRole;
    localStorage.setItem('userRole', newRole); // Сохраняем в localStorage
};

const unsetRole = ()=>{
    userRole.value = 'user'
    localStorage.removeItem('userRole')
}

defineExpose({
    setUserRole, unsetRole
});
</script>
<style lang="scss" scoped>
@use './header.scss' as *;
</style> 