<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import StateCityDropdown from '@/Components/StateCityDropdown.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    supplier_name: '',
    name: '',
    gender: '',
    age: '',
    aadhar_card_number: '',
    identity_proof: '',
    address: '',
    state: '', 
    city: '',
    phone_number: '',
    covid_status: '', 
    date_of_positive: null,
    cylinder_option: '',
});

const suppliers = ref([]);

const fetchSuppliers = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/supplier'); 
        console.log(response);
        suppliers.value = response.data; 
    } catch (error) {
        console.error('Error fetching suppliers:', error);
    }
};

onMounted(fetchSuppliers);

const submit = () => {
    form.post(route('book'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Book Cylinder" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="supplier_name" value="Supplier Name" />
                <select
                    id="supplier_name"
                    class="mt-1 block w-full"
                    v-model="form.supplier_name"
                >
                    <option value="">Select Supplier</option>
                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                        {{ supplier.name }}
                    </option>
                </select>
                <InputError :message="form.errors.supplier_name" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="cylinder_option" value="Cylinder Options" />
                <select
                    id="cylinder_option"
                    class="mt-1 block w-full"
                    v-model="form.cylinder_option"
                >
                    <option value="5">5 Ltr</option>
                    <option value="10">10 Ltr</option>
                    <option value="15">15 Ltr</option>
                </select>
                <InputError :message="form.errors.cylinder_option" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="gender" value="Gender" />
                <div class="mt-1">
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            name="gender"
                            value="Male"
                            v-model="form.gender"
                            class="form-radio"
                            required
                        />
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input
                            type="radio"
                            name="gender"
                            value="Female"
                            v-model="form.gender"
                            class="form-radio"
                            required
                        />
                        <span class="ml-2">Female</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input
                            type="radio"
                            name="gender"
                            value="Others"
                            v-model="form.gender"
                            class="form-radio"
                            required
                        />
                        <span class="ml-2">Others</span>
                    </label>
                </div>
                <InputError :message="form.errors.gender" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="covid_status" value="Covid-19 Status" />
                <select
                    id="covid_status"
                    class="mt-1 block w-full"
                    v-model="form.covid_status"
                >
                    <option value="">Select Status</option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                </select>
                <InputError :message="form.errors.covid_status" class="mt-2" />
            </div>

            <div v-if="form.covid_status === 'Positive'" class="mt-4">
                <InputLabel for="date_of_positive" value="Date of Covid-19 Positive" />
                <TextInput
                    id="date_of_positive"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.date_of_positive"
                />
                <InputError :message="form.errors.date_of_positive" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="age" value="Age" />
                <TextInput
                    id="age"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.age"
                    autocomplete="age"
                />
                <InputError :message="form.errors.age" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="aadhar_card_number" value="Aadhar Card Number" />
                <TextInput
                    id="aadhar_card_number"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.aadhar_card_number"
                    autocomplete="aadhar_card_number"
                />
                <InputError :message="form.errors.aadhar_card_number" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="identity_proof" value="Identity Proof" />
                <TextInput
                    id="identity_proof"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.identity_proof"
                    autocomplete="identity_proof"
                />
                <InputError :message="form.errors.identity_proof" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="address" value="Address" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autocomplete="address"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>

            <StateCityDropdown
                v-model:modelValueState="form.state"
                v-model:modelValueCity="form.city"
            />

            <div class="mt-4">
                <InputLabel for="phone_number" value="Phone Number" />
                <TextInput
                    id="phone_number"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    autocomplete="phone_number"
                />
                <InputError :message="form.errors.phone_number" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Book
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
