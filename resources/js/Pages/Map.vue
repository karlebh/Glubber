<template>
    <div class="min-h-screen antialiased text-center bg-gray-100">
        <section>
            <div>
                <h1 class="font-semibold mb-4 text-3xl">
                    Map: Going to {{ location.destination.name }}
                </h1>
                <div
                    class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
                >
                    <GMapMap
                        v-if="location.destination.name"
                        ref="gMap"
                        :zoom="11"
                        :center="location.destination.geometry"
                        style="width: 100%; height: 250px"
                    >
                    </GMapMap>
                    <div
                        class="bg-gray-5 px-4 py-3 text-right sm:px-6 text-white"
                    >
                        <button
                            @click.prevent="confirmTrip"
                            class="inline-flex justify-center rounded-md border border-transparent bg-teal-600 py-2 px-3"
                        >
                            Let's Go
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import Cookies from "js-cookie"
import { RouterLink, useRouter } from "vue-router"
import { ref, onMounted } from "vue"
import { useLocationStore } from "@/Store/location.js"
import axios from "axios"

const location = useLocationStore()
const router = useRouter()

const gMap = ref(null)

onMounted(async () => {
    if (!location.destination.name) router.push({ name: "find-ride" })

    await location.updateCurrentUserLocation()

    gMap.value.$mapPromise.then((mapObject) => {
        let currentPoint = new google.maps.LatLng(location.current.geometry)
        let destinationPoint = new google.maps.LatLng(
            location.destination.geometry
        )

        let directionsService = new google.maps.DirectionsService()
        let directionsDisplay = new google.maps.DirectionsRenderer({
            map: mapObject,
        })

        directionsService.route(
            {
                origin: currentPoint,
                destination: destinationPoint,
                travelMode: "DRIVING",
                avoidTolls: false,
                avoidHighways: false,
            },
            (res, status) => {
                if (status === "OK") {
                    directionsDisplay.setDirections(res)
                } else {
                    console.error(res, status)
                }
            }
        )
    })
})

async function confirmTrip() {
    try {
        await axios.post(
            "/api/trip",
            {
                origin: location.current.geometry,
                destination: location.destination.geometry,
                destination_name: location.destination.name,
            },
            {
                headers: {
                    Authorization: `Bearer ${Cookies.get("token")}`,
                },
            }
        )

        router.push({ name: "trip" })
    } catch (error) {
        console.log(error)
    }
}
</script>
