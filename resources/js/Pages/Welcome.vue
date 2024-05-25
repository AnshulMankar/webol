<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '../Components/PrimaryButton.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


const stateCounts = ref([]);

const fetchStateCounts = () => {
    axios.get('http://127.0.0.1:8000/state-counts')
        .then(response => {
            stateCounts.value = response.data;
        })
        .catch(error => {
            console.error('Error fetching state-wise counts:', error);
        });
}

onMounted(() => {
    fetchStateCounts();
});
</script>

<template>

    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Supplier Login</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Supplier Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

            <div class="flex justify-center">
                <img src="https://i.ibb.co/QnpY73c/Webol-Primary-Logo-Full-Gradient.png"
                    alt="Webol-Primary-Logo-Full-Gradient" border="0">
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">State wise Cylinder Counts</h2>
                <div v-if="stateCounts.length">
                    <table style="border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">State</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">5 ltr</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">10 ltr</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">15 ltr</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="stateCount in stateCounts" :key="stateCount.state"
                                style="border: 1px solid #ddd;">
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{ stateCount.state
                                    }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{
                                    stateCount['5ltr_count'] }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{
                                    stateCount['10ltr_count'] }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{
                                    stateCount['15ltr_count'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <p>No data available</p>
                </div>
            </div>
            <div class="mt-16">
                <div class="mt-16 flex justify-center">
                    <Link :href="route('book-cylinder')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Book Cylinder</Link>
                </div>
            </div>


        </div>

    </div>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
