<template lang="pug">
    section.admin__cabinet   
        .wrapper
            h1 Панель администратора
            button(@click='logout') Выйти
            .records 
                .record(v-for='record in this.records' :key='record.id_application')
                    h2 {{record.mark}} {{record.model}}
                    p {{record.problem}}
                    p Дата обслуживания: {{record.date}}
                    .status
                        p Статус: {{record.status}}
                        router-link(to="" @click = 'statusChange(record)')  Изменить
            .modal(v-if='modalVisible')
                .modal__content
                    h2 Редактирование статуса
                    p {{selectedRecord.mark}} {{selectedRecord.model}}
                    p Проблема: {{selectedRecord.problem}}
                    p Текущий статус: {{selectedRecord.status}}
                    label(for='status') Новый статус:
                    select(v-model='selectedStatus')
                        option(value='Ожидает') Ожидает
                        option(value='В процессе') В процессе
                        option(value='Завершено') Завершено
                    .buttons
                        button(@click='confirmStatusChange') Подтвердить
                        button(@click='modalVisible = false') Отмена
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            records: [],
            modalVisible: false,
            selectedRecord: null,
            selectedStatus: ''
        }
    },
    async mounted(){
        let token = localStorage.getItem('token');
        this.token = token
        if(!token){
            this.$router.push('/login')
        }
        try{
            const response = await axios.get(import.meta.env.VITE_BACK_URL+'/admin-get-records',{
                headers: {
                    Authorization: 'Bearer ' + this.token
                }
            })
            this.records = response.data.records
        }
        catch(error){
            const msg = error.response.data.err || 'Ошибка входа';
            alert(msg);
            this.$router.push('/user-cabinet')
        }

    },
    methods: {
        logout(){
            localStorage.removeItem('token')
            localStorage.removeItem('role');
            this.token = ''
            if(!this.token){
                this.$router.push('/login')
            }
        },
        statusChange(record){
            this.selectedRecord = record
            this.selectedStatus = record.status
            this.modalVisible = true
        },
        async confirmStatusChange(){
            try {
                await axios.post(import.meta.env.VITE_BACK_URL+'/admin-update-status', {
                    id_application: this.selectedRecord.id_application,
                    new_status: this.selectedStatus
                }, {
                    headers: {
                        Authorization: 'Bearer ' + this.token
                    }
                });
                const response = await axios.get(import.meta.env.VITE_BACK_URL+'/admin-get-records', {
                    headers: {
                        Authorization: 'Bearer ' + this.token
                    }
                });
                this.records = response.data.records;

                // Сбрасываем модалку и выбор
                this.modalVisible = false;
                this.selectedRecord = null;
                this.selectedStatus = '';
            } catch (error) {
                alert('Не удалось обновить статус');
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
        .record{
            .status{
                display: flex;
                align-items: center;
                gap: 30px;
                a{
                    font-size: 1.2rem;
                }
            }
        }
    }

    .modal {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
        &__content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            width: 600px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            p{
                margin: 0.5rem 0;
            }
            h2{
                margin: 0;
            }
            select{
                height:  2rem;
                font-size: 1.5rem;
                padding-left: 1rem;
            }
        }
        .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
    }
}
</style>