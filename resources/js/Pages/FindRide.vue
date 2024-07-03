<script setup>
import Cookies from "js-cookie";
import { RouterLink, useRouter } from "vue-router";
import { ref } from "vue";
import { useLocationStore } from "@/Store/location.js";

const name = Cookies.get("name");
const router = useRouter();
const location = useLocationStore();

function setPlace(e) {
    console.log(e);
    location.$patch({
        destination: {
            name: e.name,
            address: e.formatted_address,
            geometry: {
                lat: e.geometry.location.lat(),
                lng: e.geometry.location.lng(),
            },
        },
    });
}

function toMap() {
    if (!location.destination.name) return;
    router.push({ name: "map" });
}
</script>

<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <section>
            <div>
                <h1 class="font-semibold mb-4 text-3xl">Find A Ride</h1>
                <div
                    class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
                >
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <GMapAutocomplete
                            placeholder="My destination"
                            @place_changed="setPlace"
                            class="block w-full shadow-md border border-gray-300 px-3 py-2 mt-1"
                        >
                        </GMapAutocomplete>
                    </div>

                    <div
                        class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white"
                    >
                        <button
                            @click.prevent="toMap"
                            class="inline-flex justify-center rounded-md border border-transparent bg-amber-600 py-2 px-3"
                        >
                            Take To Map
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
