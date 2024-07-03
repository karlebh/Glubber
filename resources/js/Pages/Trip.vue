<script setup>
import Cookies from "js-cookie"
import { RouterLink, useRouter } from "vue-router"
import { ref } from "vue"
import { useLocationStore } from "@/Store/location.js"
</script>

<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <section>
            <div>
                <h1 class="font-semibold mb-4 text-3xl">Waitin For A Driver</h1>
                <div
                    class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
                >
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <GMapMap
                            :zoom="14"
                            ref="gMap"
                            style="width: 100%; height: 256px"
                        >
                        </GMapMap>
                    </div>

                    <div
                        class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-black"
                    >
                        <span
                            >When a driver accept this ride, their info will
                            display here</span
                        >
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
