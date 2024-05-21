<script>
export default {
    name: "Nav"
}
</script>

<template>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <RouterLink
                to="/"
                activeClass="active"
                class="nav-link"
            >Список новостей</RouterLink>
        </li>
        <li class="nav-item">
            <RouterLink
                to="/categories"
                activeClass="active"
                class="nav-link"
            >По категориям</RouterLink>
        </li>
    </ul>
</template>
