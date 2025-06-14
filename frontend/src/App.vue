<template lang="pug">
    Header(ref='header')
    RouterView
</template>
<script>
import Header from './components/Header/Header.vue'
export default {
    components: {
        Header
    }
}
</script>
