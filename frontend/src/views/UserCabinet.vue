<template lang="pug">
    h1 Личный кабинет
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            response: null
        }
    },
    async mounted(){
        let token = localStorage.getItem('jwt');
        if(!token){
            this.$router.push('/login')
        }
        try{
            const response = await axios.get(import.meta.env.VITE_BACK_URL +'/getRecords')
        }
        catch{

        }

    }
}
</script>
<style lang="scss" scoped>
    h1{
        padding-left: 2rem;
    }
</style>