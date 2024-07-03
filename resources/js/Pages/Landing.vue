<script setup>
import Cookies from "js-cookie"
import { RouterLink, useRouter } from "vue-router"
import axios from "axios"

const name = Cookies.get("name")
// Cookies.remove("token")

const router = useRouter()

async function startDriving() {
    try {
        const { data } = await axios.get("/api/driver")
        if (data.driver) router.push({ name: "stand-by" })
        else router.push({ name: "create-driver" })
    } catch (error) {
        console.log(error)
    }
}
</script>

<template>
    <div>
        <h1 class="font-semibold mb-4 text-3xl text-center">
            Drive or be driven?
        </h1>
        <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto">
            <div class="text-white px-4 py-5 sm:p-6">
                <button
                    @click.prevent="startDriving"
                    class="block w-full shadow-md border bg-black border-gray-300 px-3 py-2 mt-1"
                >
                    Start Driving
                </button>
            </div>

            <div class="bg-gray-5 px-4 py-3 sm:px-6 text-white">
                <RouterLink
                    :to="{ name: 'find-ride' }"
                    class="block w-full shadow-md border bg-green-600 border-gray-300 px-3 py-2 mt-1"
                >
                    Find a Ride
                </RouterLink>
            </div>
        </div>
        <!-- </form> -->
    </div>
</template>
