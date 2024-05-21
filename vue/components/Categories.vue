<script>
import axios from "axios";
import Loader from "@/components/Loader.vue";
import CategoriesCount from "./CategoriesCount.vue";
import functions from "../common/functions.js";

export default {
    name: "FavoritesCategories",
    components: {
        Loader,
        'CategoriesCount': CategoriesCount
    },
    props: {
        title: String,
        url: String,
    },
    data() {
        return {
            categories: {},
            loader: false
        }
    },
    created() {
        this.loader = true;
        this.getElementsAndSetCategories();
        this.getRandomSeconds = functions.getRandomSeconds
    },
    methods: {
        getElementsAndSetCategories() {
            axios.get(this.url)
                .then((response) => {
                    if (response?.status === 200) {
                        setTimeout(() => {
                            this.loader = false;
                            this.setCategories(this.getElements(response));
                        }, this.getRandomSeconds(1, 5));
                    }
                })
                .catch((error) => {
                    console.error(error);
                })
        },
        setCategories(elements) {
            let categories = {};

            elements.forEach(element => {
                if (!categories.hasOwnProperty(element.category)) {
                    categories[element.category] = 1;
                } else {
                    categories[element.category]++;
                }
            });

            if (Object.keys(categories).length > 0) {
                this.categories = categories;
            }

            this.updateCategories();
        },
        updateCategories() {
            this.$refs.categoriesCount.updateList(this.categories);
        },
        getElements(response) {
            return response?.data?.elements ? Object.values(response.data.elements) : response.data;
        }
    }
}
</script>

<template>
    <h3 class="mb-4 text-center">{{ title }}</h3>
    <Loader v-if="loader" />
    <categories-count ref="categoriesCount" />
</template>
