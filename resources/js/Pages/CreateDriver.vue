<script setup>
import { reactive, ref } from "vue"

const driver = reactive({
    name: "",
    year: "",
    make: "",
    model: "",
    color: "",
    license_plate: "",
})
</script>

<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <h1 class="font-semibold text-3xl mb-4">Driver and Car details</h1>

        <div
            class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
        >
            <div class="bg-white px-4 py-6 space-y-3">
                <div class="bg-white px-4">
                    <input
                        id="name"
                        placeholder="Full Name"
                        v-model="driver.name"
                        class="block w-full shadow border border-gray-300 px-3 py-2"
                    />
                </div>
                <div class="bg-white px-4">
                    <input
                        id="year"
                        placeholder="Car Year"
                        v-model="driver.year"
                        class="block w-full shadow-md border border-gray-300 px-3 py-2"
                    />
                </div>
                <div class="bg-white px-4">
                    <input
                        id="make"
                        placeholder="Make"
                        v-model="driver.make"
                        class="block w-full shadow-md border border-gray-300 px-3 py-2"
                    />
                </div>
                <div class="bg-white px-4">
                    <input
                        id="model"
                        placeholder="model"
                        v-model="driver.model"
                        class="block w-full shadow-md border border-gray-300 px-3 py-2"
                    />
                </div>
                <div class="bg-white px-4">
                    <input
                        id="color"
                        placeholder="color"
                        v-model="driver.color"
                        class="block w-full shadow-md border border-gray-300 px-3 py-2"
                    />
                </div>
                <div class="bg-white px-4">
                    <input
                        id="license_plate"
                        placeholder="license_plate"
                        v-model="driver.license_plate"
                        class="block w-full shadow-md border border-gray-300 px-3 py-2"
                    />
                </div>
            </div>

            <div class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white">
                <button
                    @click.prevent=""
                    class="inline-flex justify-center rounded-md border border-transparent bg-teal-600 py-2 px-3"
                >
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>
