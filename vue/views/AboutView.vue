<script>
import Categories from "../components/Categories.vue";
import functions from "../common/functions.js";

export default {
    name: 'AboutView',
    computed: {
        functions() {
            return functions
        }
    },
    components: {
        Categories,
    },
}
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <Categories
                    :title="'Категории новостей'"
                    :url="'https://jsonplaceholder.org/posts'"
                />
            </div>
            <div class="col-6">
                <Categories
                    :title="'Категории избранных новостей'"
                    :url="functions.getUrl() + '/favorites'"
                />
            </div>
        </div>
    </div>
</template>
