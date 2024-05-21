<script setup>
import Favorites from "../components/Favorites.vue";
import News from "../components/News.vue";
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <News
                    @addedToFavorites="addedToFavorites"
                    ref="news"
                />
            </div>
            <div class="col-4">
                <Favorites ref="favorites" />
            </div>
        </div>
    </div>
</template>

<script>
import Favorites from "../components/Favorites.vue";
import News from "../components/News.vue";

export default {
    name: 'HomeView',
    components: {
        'favorites': Favorites,
        'news': News
    },
    data() {
        return {
            loader: false,
        }
    },
    methods: {
        addedToFavorites(id, title, category) {
            this.$refs.favorites.updateFavorites(id, title, category);
        },
    }
}
</script>