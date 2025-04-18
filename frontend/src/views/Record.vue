<template lang="pug">
    section.record
        h1 Запись на 
        .form__inner
            form.form(@submit.prevent='handleSubmit')
                div.input__group
                    label(for='#fio') Марка
                    input(type='text' id='mark' v-model='this.form.mark')
                    span.error(v-if="errors.mark") {{ errors.mark }}
                div.input__group
                    label(for='#model') Модель
                    input(type='text' id='model' v-model='this.form.model')
                    span.error(v-if="errors.model") {{ errors.model }}
                div.input__group
                    label(for='#text') Описание неисправности
                    input(type='text' id='text' v-model='this.form.text' max='2')
                    span.error(v-if="errors.text") {{ errors.text }}    
                .input__group
                    label(for='#date') Дата обслуживания
                    input(type='date' id='date' v-model='this.form.date')
                    span.error(v-if="errors.date") {{ errors.date }}
                input(type='submit')
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            form: {
                model: null,
                mark: null,
                date: null,
                text: null
            },
            errors: {},
            token: null
        }
    },
    methods: {
        validateForm(){
            this.errors = {}
            let valid = true
            if (!this.form.mark || !/^[А-Яа-яЁёA-Za-z0-9\s\-\.]{3,50}$/.test(this.form.mark)) {
                this.errors.mark = 'Обязательное поле. До 50 символов. Без лишних символов (,?!()]*<+)'
                valid = false
            }
            if (!this.form.model || !/^[А-Яа-яЁёA-Za-z0-9\s\-\.]{1,50}$/.test(this.form.model)) {
                this.errors.model = 'Обязательное поле. До 50 символов. Без лишних символов (,?!()]*<+)'
                valid = false
            }
            if (!this.form.text || !/^[А-Яа-яЁёA-Za-z0-9\s\-\.?!]{3,500}$/.test(this.form.text)) {
                this.errors.text = 'Обязательное поле. До 500 символов. Без лишних символов (,()]*<+)'
                valid = false
            }
            if (!this.form.date){
                this.errors.date = 'Выберите дату'
                valid = false
            }
            return valid
        },
        async handleSubmit(){
            if (!this.validateForm()) {
                return
            }
            try{
                const response = await axios.post(import.meta.env.VITE_BACK_URL+'/set-record',
                {
                    "mark": this.form.mark, "model": this.form.model, "text": this.form.text, "date": this.form.date
                },
                {
                    headers: {
                        Authorization: 'Bearer' + this.token
                    }
                })
                this.$router.push('/user-cabinet')
            }
            catch(error){
                const msg = error.response?.data || "Ошибка записи";
                alert(msg);
            }
        }
    },
    mounted(){
        let token = localStorage.getItem('token');
        this.token = token
        if(!token){
            this.$router.push('/login')
        }
        // localStorage.setItem('jwt', '123123123')
        // localStorage.removeItem('jwt')
        // const token = localStorage.getItem('jwt')
        // console.log(token)
    }
}
</script>
<style lang="scss" scoped>
    h1{
        padding-left: 2rem;
    }
    .record{
        form{
            display: flex;
            flex-direction: column;
            width: 500px;
            border: 2px solid black;
            border-radius: 5px;
            padding: 1rem 1rem;
            gap: 1rem;
            font-size: 1.5rem;
            .input__group{
                display: flex;
                flex-direction: column;
                gap: 10px;
                input{
                    height:  2rem;
                    font-size: 1.5rem;
                    padding-left: 1rem;
                }
                span.error{
                    font-size: 1.1rem;
                    color: red;
                }
                .radio__group{
                    .radio__item{
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        input{
                            width: 17px;
                        }
                    }
                }
            }
        }
    }
</style>