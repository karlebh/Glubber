<script setup>
import { RouterLink } from "vue-router"
</script>

<template>
    <div class="text-center">
        <h1 class="text-3xl">Are you lost?</h1>

        <RouterLink
            class="text-3xl underline mt-8 text-teal-700"
            :to="{ name: 'index' }"
            >Go Home</RouterLink
        >
    </div>
</template>
