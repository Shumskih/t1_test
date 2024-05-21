<script>
import axios from "axios";
import NewsItem from "./NewsItem.vue";
import Loader from "@/components/Loader.vue";
import functions from "../common/functions.js";

export default {
    name: "News",
    components: {
        'loader': Loader,
        'newsItem': NewsItem,
    },
    data() {
        return {
            items: [],
            itemsTotal: 0,
            loader: false,
            page: 1,
            paginationOffset: 0,
            itemsPerPage: 4,
            pagesCount: 25
        }
    },
    mounted() {
        this.loader = true;
        this.setList();
        this.getRandomSeconds = functions.getRandomSeconds
    },
    methods: {
        setList() {
            axios.get('https://jsonplaceholder.org/posts')
                .then((response) => {
                    if (response?.status === 200) {
                        setTimeout(() => {
                            this.loader = false;
                            this.itemsTotal = response.data.length;
                            this.items = response.data.splice(this.paginationOffset, this.itemsPerPage);
                        }, this.getRandomSeconds(1, 5));
                    }
                })
                .catch((error) => {
                    console.error(error, 'posts');
            })
        },
        addToFavorites(id, title, category) {
            axios
                .post(functions.getUrl() +  '/favorites', {
                    id: id,
                    title: title,
                    category: category,
                })
                .then((response) => {
                    setTimeout(() => {
                        if (
                            response?.status === 200
                            && response?.data?.status === 'success'
                        ) {
                            this.$emit('addedToFavorites', id, title, category);

                            if (response?.data?.message) {
                                alert(response?.data?.message);
                            }
                        }

                        this.unblockButton(id);
                    }, this.getRandomSeconds(1, 5));
                })
                .catch((error) => {
                    if (error?.response?.data?.message) {
                        alert(error?.response?.data?.message);
                    }
                    this.unblockButton(id);
                })
        },
        unblockButton(newsId) {
            this.$refs.newsItem.forEach((element) => {
                element.unblockButton(newsId);
            })
        },
        changePage(pageNumber) {
            this.loader = true;
            this.page = pageNumber;
            this.paginationOffset = (this.itemsPerPage * pageNumber) - this.itemsPerPage;
            this.setList();
            window.scrollTo(0, 0);
        },

    }
}
</script>

<template>
    <h3 class="mb-4 text-center">Новости</h3>
    <paginate
        v-if="!loader"
        v-model="page"
        :page-count="pagesCount"
        :click-handler="changePage"
        :prev-text="'Назад'"
        :next-text="'Вперёд'"
        :container-class="'pagination justify-content-center flex-wrap mb-5'"
    >
    </paginate>
    <loader v-if="loader" />
    <ul v-else class="list-group list-group-flush">
        <news-item
            v-for="item of items"
            :key="item.id"
            :item="item"
            @addToFavorites="addToFavorites(item.id, item.title, item.category)"
            ref="newsItem"
        />
    </ul>
</template>
