<script>
export default {
    name: "FavoritesItem",
    props: {
        title: String,
        category: String
    },
}
</script>

<template>
    <li class="list-group-item">
        <div class="w-75">{{ title }} <kbd>{{ category }}</kbd></div>
        <button
            type="button"
            class="btn-close"
            @click="$emit('removeFromFavorites')"
        ></button>
    </li>
</template>

<style scoped>
.btn-close {
    position: absolute;
    top: 7px;
    right: 10px;
}
</style>