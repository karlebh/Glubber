<script setup>
import axios from "axios"
import { ref } from "vue"
import { useRouter } from "vue-router"
import Cookies from "js-cookie"

const phone = ref()
const login_code = ref()
const router = useRouter()
const loggedIn = ref(false)
const authToken = ref([])

Cookies.set("name", "Caleb", { expires: 7 })
Cookies.set("token", "12idhiuffnfmf", { expires: 7 }) // FOR TESTING PURPOSE ONLY SINCE SENDING SMS IS GIVING ISSUES FOR NOW
async function loginUser() {
    // loggedIn.value = !loggedIn.value;

    try {
        const res = await axios.post("/api/login", {
            phone: "+234" + phone.value,
        })
        loggedIn.value = !loggedIn.value
    } catch (e) {
        console.log(e.response.data.message)
    }
}

async function verifyUser() {
    // loggedIn.value = !loggedIn.value;
    try {
        const res = await axios.post("/api/verify", {
            phone: "+234" + phone.value,
            login_code: login_code.value,
        })
        loggedIn.value = !loggedIn.value
        router.push({ name: "index" })
        authToken.push(res.data.token)
        Cookies.set("token", authToken.value, { expires: 0.5 })
    } catch (e) {
        console.log(e.response.data.message)
    }
}
</script>

<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <section v-if="!loggedIn">
            <div>
                <h1 class="font-semibold mb-4 text-3xl">Enter Your Number</h1>

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

                    <div
                        class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white"
                    >
                        <button
                            @click.prevent="loginUser"
                            class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="loggedIn">
            <div>
                <h1 class="font-semibold mb-4 text-3xl">
                    Enter Your Login Code
                </h1>

                <div
                    class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
                >
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <input
                            type="number"
                            id="login_code"
                            placeholder=""
                            v-model="login_code"
                            class="block w-full shadow-md border border-gray-300 px-3 py-2 mt-1"
                        />
                    </div>

                    <div
                        class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white"
                    >
                        <button
                            @click.prevent="verifyUser"
                            class="inline-flex justify-center rounded-md border border-transparent bg-green-400 py-2 px-3"
                        >
                            Verify
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
