<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const bookings = ref(props.bookings);
const states = ref([]);
const cylinderOptions = ref([]);
const selectedState = ref('');
const selectedCylinderOption = ref('');

const statesData = [
    'Arunachal Pradesh',
    'Assam',
    'Andhra Pradesh',
    'Bihar',
    'Chhattisgarh',
    'Goa',
    'Gujarat',
    'Haryana',
    'Himachal Pradesh',
    'Jharkhand',
    'Karnataka',
    'Kerala',
    'Madhya Pradesh',
    'Maharashtra',
    'Manipur',
    'Meghalaya',
    'Mizoram',
    'Nagaland'];
const cylinderOptionsData = ['15', '10', '5'];

const filterBookings = () => {
    const selectedStateValue = selectedState.value;
    const selectedCylinderOptionValue = selectedCylinderOption.value;

    const filteredBookings = props.bookings.filter(booking => {
        const matchesState = !selectedStateValue || booking.state === selectedStateValue;
        const matchesCylinderOption = !selectedCylinderOptionValue || booking.cylinder_option === selectedCylinderOptionValue;
        return matchesState && matchesCylinderOption;
    });

    bookings.value = filteredBookings;
}

const updateStatus = (bookingId, newStatus) => {
    axios.post('http://127.0.0.1:8000/changeStatus', {
        id: bookingId,
        status: newStatus
    })
        .then(response => {
            bookings.value = response.data.bookings;
            location.reload();
        })
        .catch(error => {
            console.error('Error updating status:', error);
        });
}

states.value = statesData;
cylinderOptions.value = cylinderOptionsData;
</script>
<template>
    <div>

        <Head title="Dashboard" />
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Your Bookings</h3>

                        <div class="flex space-x-4 mb-4">
                            <select v-model="selectedState" @change="filterBookings">
                                <option value="">Select States</option>
                                <option v-for="state in states" :key="state" :value="state">{{ state }}</option>
                            </select>
                            <select v-model="selectedCylinderOption" @change="filterBookings">
                                <option value="">Select Cylinder Options</option>
                                <option v-for="option in cylinderOptions" :key="option" :value="option">{{ option }}
                                </option>
                            </select>
                        </div>

                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200">Name</th>
                                    <th class="py-2 px-4 border-b border-gray-200">Status</th>
                                    <th class="py-2 px-4 border-b border-gray-200">Change Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="booking in bookings" :key="booking.id">
                                    <td class="py-2 px-4 border-b border-gray-200">{{ booking.name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ booking.status }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <button @click="updateStatus(booking.id, 'delivered')"
                                            class="text-sm text-green-500">Delivered</button> <br>
                                        <button @click="updateStatus(booking.id, 'cancelled')"
                                            class="text-sm text-red-500">Cancelled</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>