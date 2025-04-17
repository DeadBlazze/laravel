<template lang="pug">
    div 1234
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
        try{
            const response = await axios.get(import.meta.env.VITE_BACK_URL +'/getRecords')
        }
        catch{

        }

    }
}
</script>
<style lang="">
    
</style>