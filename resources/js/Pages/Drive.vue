<script setup>
import Cookies from "js-cookie"
import { RouterLink } from "vue-router"
import { ref } from "vue"

const location = ref()
</script>

<template>
    <div>
        <h1 class="font-semibold mb-4 text-3xl text-center"></h1>
        <div
            class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
        >
            <div class="bg-white px-4 py-5 sm:p-6">
                <input
                    type="number"
                    id="phone"
                    placeholder=""
                    v-model="location"
                    class="block w-full shadow-md border border-gray-300 px-3 py-2 mt-1"
                />
            </div>
        </div>
    </div>
</template>
