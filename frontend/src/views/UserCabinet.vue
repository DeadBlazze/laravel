<template lang="pug">
    section.user__cabinet    
        .wrapper
            h1 Личный кабинет
            h2(v-if='!this.records[0]')
                | У вас ещё нет заявок 
                router-link(to="/record") Оставьте заявку здесь
            button(@click='logout') Выйти
            .records 
                .record(v-for='record in this.records' :key='record.id_application')
                    h2 {{record.mark}} {{record.model}}
                    P {{record.problem}}
                    p Дата обслуживания: {{record.date}}
                    p Статус: {{record.status}}
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            response: null,
            records: []
        }
    },
    async mounted(){
        let token = localStorage.getItem('token');
        this.token = token
        if(!token){
            this.$router.push('/login')
        }
        try{
            const response = await axios.get(import.meta.env.VITE_BACK_URL +'/get-records',{
                headers: {
                    Authorization: 'Bearer ' + this.token
                }
            })
            this.records = response.data.records
        }
        catch(error){
            const msg = response.data || 'Ошибка загрузки заявок'
            alert(msg)
        }
    },
    methods: {
        logout(){
            localStorage.removeItem('token')
            this.token = ''
            if(!this.token){
                this.$router.push('/login')
            }
        }
    }
}
</script>
<style lang="scss" scoped>
.wrapper{
    padding: 0 10%;
    p   {
        font-size: 1.3rem;
    }
    h2{
        font-weight: 600;
    }
    h1{
        margin-bottom: 1rem;

    }
    .records{
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
}
</style>