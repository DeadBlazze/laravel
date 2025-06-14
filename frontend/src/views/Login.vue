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
                    router-link(to="/reg") Не зарегистрированы?
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
                return 
            }
            try{
                const response = await axios.post(import.meta.env.VITE_BACK_URL+'/auth',{
                    "email":this.form.email,
                    "password":this.form.password
                })
                if(response.data.token){
                    localStorage.setItem('token', response.data.token);
                    let role = response.data.role
                    const header = this.$root.$refs.header;
                    header.setUserRole(role);
                    if(role === 'admin'){
                        this.$router.push('/admin')
                    }
                    else{
                        this.$router.push('/user-cabinet')
                    }
                }
                else{
                    alert('Ошибка входа'); 
                }
            }
            catch(error){
                const msg = error.response?.data.err || error;
                alert(msg);
            }
        }
    }
}
</script>
<style lang="scss" scoped>
    .form__inner{
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 5rem;
        h1{
            width: fit-content;
        }
        form{
            display: flex;
            flex-direction: column;
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
                    font-size: 1.3rem;
                }
            }

        }
    }
    
</style>