<template lang="pug">
    section.reg
        .form__inner
            form.form(@submit.prevent='handleSubmit')
                div.input__group
                    label(for='#fio') ФИО
                    input(type='text' id='fio' v-model='this.form.fio')
                    span.error(v-if="errors.fio") {{ errors.fio }}
                .input__group
                    label(for='#birthday') Дата рождения
                    input(type='date' id='birthday' v-model='this.form.birthday')
                    span.error(v-if="errors.birthday") {{ errors.birthday }}
                .input__group
                    label(for='#male') Пол
                    .radio__group
                        .radio__item
                            input(type='radio' name='male' id='male1' value='Мужской' v-model='this.form.male')
                            label(for='male1') Мужской
                        .radio__item
                            input(type='radio' name='male' id='male2' value='Женский' v-model='this.form.male')
                            label(for='male2') Женский
                    span.error(v-if="errors.male") {{ errors.tel }}
                .input__group
                    label(for='#tel') Телефон
                    input(type='tel' id='tel' v-model='this.form.tel')
                    span.error(v-if="errors.tel") {{ errors.tel }}
                .input__group
                    label(for='#email') Почта
                    input(type='email' id='email' v-model='this.form.email')
                    span.error(v-if="errors.email") {{ errors.email }}
                .input__group
                    label(for='#password') Пароль
                    input(type='text' id='password' v-model='this.form.password')
                    span.error(v-if="errors.password") {{ errors.password }}
                input(type='submit')
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            form: {
                fio: null,
                birthday: null,
                male: null,
                tel: null,
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
            if (!/^[А-Яа-яЁёA-Za-z\s\-]{5,100}$/.test(this.form.fio)) {
                this.errors.fio = 'ФИО должно содержать только буквы, пробелы'
                valid = false
            }
            if (!/^[0-9A-Za-z_.+-]{1,64}@[0-9A-Za-z_-]{1,10}\.[0-9A-Za-z_-]{2,6}$/.test(this.form.email)) {
                this.errors.email = 'Некорректный email'
                valid = false
            }
            if (!/^(?:\+7|8)\d{10}$/.test(this.form.tel)) {
                this.errors.tel = 'Телефон должен начинаться с +7 или 8 и содержать ровно 11 цифр';
                valid = false;
            }
            if (!/^(?=.*[.!,?])[0-9A-Za-z\s.!,?-]{8,40}$/.test(this.form.password)) {
                this.errors.password = 'Пароль должен быть от 8 символов и содержать спец символ(!.,?-)'
                valid = false
            }
            if (!this.form.male){
                this.errors.male = 'Выберите пол'
                valid = false
            }
            if (!this.form.birthday){
                this.errors.birthday = 'Выберите дату рождения'
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
        justify-content: center;
        padding-top: 5rem;
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