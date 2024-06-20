<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header> </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae
                qui voluptas eaque est sit eius necessitatibus maiores
                praesentium natus animi! Harum, ad quam asperiores repellendus
                dolor ipsam voluptatem sequi quia?
            </div>
        </div>
    </AuthenticatedLayout>
</template>
