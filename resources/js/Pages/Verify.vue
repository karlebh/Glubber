<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { RouterLink } from "vue-router";

const login_code = ref();
const router = useRouter();

async function loginUser() {
    try {
        const res = await axios.post("/api/verify", {
            login_code: login_code.value,
        });
    } catch (e) {
        console.log(e.response.data.message);
    }
}
</script>

<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <div>
            <h1 class="font-semibold mb-4 text-3xl">Enter Your Number</h1>

            <RouterLink :to="{ name: 'login' }"
                >Go back to enter your phone number</RouterLink
            >

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
                        @click.prevent="loginUser"
                        class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3"
                    >
                        Submit
                    </button>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</template>
