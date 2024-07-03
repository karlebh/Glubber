import { defineStore } from "pinia"
import { ref, reactive, computed } from "vue"

const getUserLocation = async () => {
    return new Promise((res, req) => {
        navigator.geolocation.getCurrentPosition(res, req)
    })
}

export const useLocationStore = defineStore("location", () => {
    const destination = reactive({
        name: "",
        address: "",
        geometry: {
            lat: "",
            lng: "",
        },
    })

    const current = reactive({
        geometry: {
            lat: "",
            lng: "",
        },
    })

    const updateCurrentUserLocation = async () => {
        const userLocation = await getUserLocation()
        current.geometry = {
            lat: userLocation.coords.latitude,
            lng: userLocation.coords.longitude,
        }
    }

    return {
        destination,
        current,
        updateCurrentUserLocation,
    }
})
