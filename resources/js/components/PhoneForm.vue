<script setup>
import { RouterLink, useRouter } from "vue-router";

// const props = defineProps(["number"]);
</script>

<template>
    <div>
        <h1 class="font-semibold mb-4 text-3xl">Enter Your Number</h1>

        <!-- <RouterLink :to="{ name: 'verify' }">Test Verify page</RouterLink> -->

        <!-- <form action="#"> -->
        <div
            class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
        >
            <div class="bg-white px-4 py-5 sm:p-6">
                <input
                    type="number"
                    id="phone"
                    placeholder=""
                    v-model="phone"
                    class="block w-full shadow-md border border-gray-300 px-3 py-2 mt-1"
                />
            </div>

            <div class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white">
                <button
                    @click.prevent="$emit('login')"
                    class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3"
                >
                    Submit
                </button>
            </div>
        </div>
        <!-- </form> -->
    </div>
</template>
