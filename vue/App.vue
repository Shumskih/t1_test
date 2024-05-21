<script>
import Header from './components/Header.vue'
import 'bootstrap/dist/css/bootstrap.min.css'

export default {
    name: 'App',
    components: {
        Header
    },
}
</script>

<template>
    <Header />
    <RouterView />
</template>

<style>
.page-link {
    cursor: pointer;
}
</style>
