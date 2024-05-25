<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import StateCityDropdown from '@/Components/StateCityDropdown.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    gender: '',
    age: '',
    aadhar_card_number: '',
    identity_proof: '',
    address: '',
    state: '', 
    city: '',
    phone_number: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
    <GuestLayout>
        <Head title="Supplier Register" />

        <form @submit.prevent="submit">
            <div>
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
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
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
    <InputError class="mt-2" :message="form.errors.gender" />
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
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <!-- End of Additional Fields -->

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
