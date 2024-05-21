<script>
import axios from "axios";
import FavoritesItem from "./FavoritesItem.vue";
import Loader from "./Loader.vue";
import functions from "../common/functions.js";

export default {
    name: "Favorites",
    components: {
        FavoritesItem,
        Loader
    },
    data() {
        return {
            items: [],
            loader: false,
            noContent: false,
        }
    },
    mounted() {
        this.enableLoader();
        this.setList();
        this.getRandomSeconds = functions.getRandomSeconds
    },
    methods: {
        setList() {
            axios.get(functions.getUrl() +  '/favorites')
                .then((response) => {
                    if (response?.status === 200) {
                        setTimeout(() => {
                            this.items = Object.values(response.data.elements);
                            this.disableLoader();
                        }, this.getRandomSeconds(1, 5));
                    }
                })
        },
        removeFromFavorites(id) {
            this.enableLoader();

            axios.delete(functions.getUrl() +  '/favorites/' + id)
                .then((response) => {
                    if (response?.status === 200) {
                        setTimeout(() => {
                            this.setList();
                        }, this.getRandomSeconds(1, 5));
                    }
                })
        },
        updateFavorites(id, title, category) {
            this.items.push({id, title, category});
            this.noContent = false;
        },
        enableLoader() {
            this.loader = true;
            this.noContent = false;
        },
        disableLoader() {
            this.loader = false;
            this.noContent = this.items.length < 1;
        },
    },
}
</script>

<template>
    <h3 class="mb-4">Избранное</h3>
    <Loader v-if="loader" />
    <div v-else-if="noContent" class="alert alert-dark" role="alert">
        Новостей в избранном нет!
    </div>
    <ul v-else class="list-group">
        <FavoritesItem
            v-for="item of items"
            :title="item.title"
            :category="item.category"
            @removeFromFavorites="removeFromFavorites(item.id)"
        />
    </ul>
</template>
