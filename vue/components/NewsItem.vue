<script>
export default {
    name: 'NewsItem',
    emits: ['addToFavorites'],
    props: {
        item: Object,
    },
    data() {
        return {
            blockButton: false,
            inFavorites: false
        }
    },
    methods: {
        handleClick() {
            if (this.blockButton) {
                return;
            }

            this.blockButton = true;
            this.$emit('addToFavorites')
        },
        unblockButton(newsId) {
            if (
                this.blockButton
                && this.item.id === newsId
            ) {
                this.blockButton = !this.blockButton;
            }
        }
    }
}
</script>

<template>
    <li class="list-group-item d-flex row justify-content-between align-items-center">
        <div class="d-flex flex-column col-9">
            <div class="align-middle"><code>title: </code>{{ item.title }}</div>
            <span><code>category: </code> <i><kbd>{{ item.category }}</kbd></i></span>
        </div>
        <button
            type="button"
            class="btn btn-light col-3"
            @click="handleClick"
            :disabled="blockButton"
        >
            <span v-if="blockButton" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            В избранное
        </button>
    </li>
</template>
