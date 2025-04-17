<template lang="pug">
    h1 запись в 
</template>
<script>
export default {
    mounted(){
        let token = localStorage.getItem('jwt');
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
<style lang="">
    
</style>