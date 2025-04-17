<template lang="pug">
    section.reg
        .form__inner
            h1 Авторизация
            form.form(@submit.prevent='handleSubmit')
                .input__group
                    label(for='#email') Почта
                    input(type='email' id='email' v-model='this.form.email')
                    span.error(v-if="errors.email") {{ errors.email }}
                .input__group
                    label(for='#password') Пароль
                    input(type='text' id='password' v-model='this.form.password')
                    span.error(v-if="errors.password") {{ errors.password }}
                .button__group
                    input(type='submit' value='Войти')
                    router-link(to="/reg") Не зарегистрированы
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            form: {
                email: null,
                password: null
            },
            errors: {}
        }
    },
    methods:{
        validateForm(){
            this.errors = {}
            let valid = true
            if (!/^[0-9A-Za-z_.+-]{1,64}@[0-9A-Za-z_-]{1,10}\.[0-9A-Za-z_-]{2,6}$/.test(this.form.email)) {
                this.errors.email = 'Некорректный email'
                valid = false
            }
            if (!/^(?=.*[.!,?])[0-9A-Za-z\s.!,?-]{8,40}$/.test(this.form.password)) {
                this.errors.password = 'Пароль должен быть от 8 символов и содержать спец символ(!.,?-)'
                valid = false
            }
            return valid
        },
        async handleSubmit(){
            if (!this.validateForm()) {
                console.log('Всё плохо') 
                return 
            }
            try{
                const response = await axios.post(import.meta.env.VITE_BACK_URL+'/register',{
                    "fio":this.form.fio,
                    "birthday":this.form.birthday,
                    "male":this.form.male,
                    "tel":this.form.tel,
                    "email":this.form.email,
                    "password":this.form.password,
                })
                console.log(response.data)
            }
            catch(error){
                const msg = error.response?.data || 'Ошибка входа';
                alert(msg);
            }
            console.log('Всё чётко')
        }
    }
}
</script>
<style lang="scss">
    .form__inner{
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 5rem;
        h1{
            width: 500px;
        }
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
                input[type='submit']{
                    align-self: flex-start;
                }
                span.error{
                    font-size: 1.1rem;
                    color: red;
                }
            }
            .button__group{
                display: flex;
                gap: 10px;
                align-items: center;
                a{
                    font-size: 1.5rem;
                }
            }

        }
    }
    
</style>