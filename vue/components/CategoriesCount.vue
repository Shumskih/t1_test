<script>
export default {
    name: "CategoriesCount",
    data() {
        return {
            list: [],
            isEmpty: false
        }
    },
    methods: {
        updateList(list) {
            this.list = list

            if (Object.keys(this.list).length < 1) {
                this.isEmpty = true;
            }
        }
    }
}
</script>

<template>
    <ul v-if="!isEmpty" class="list-group">
        <li
            v-for="(count, item) in list"
            class="list-group-item d-flex justify-content-between align-items-center"
        >
            {{ item }}
            <span class="badge bg-primary rounded-pill">{{ count }}</span>
        </li>
    </ul>
    <div v-else class="alert alert-dark" role="alert">Нет данных</div>
</template>
