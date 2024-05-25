<!-- StateCityDropdown.vue -->
<template>
    <div>
        <InputLabel for="state" value="State" />
        <select v-model="localState" id="state" @change="onStateChange">
            <option value="">Select State</option>
            <option v-for="state in states" :key="state.name" :value="state.name">{{ state.name }}</option>
        </select>

        <InputLabel for="city" value="City" />
        <select v-model="localCity" id="city" :disabled="!localState">
            <option value="">Select City</option>
            <option v-for="city in filteredCities" :key="city" :value="city">{{ city }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: 'StateCityDropdown', 
    props: {
        modelValueState: {
            type: String,
            default: ''
        },
        modelValueCity: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            states: [
                { name: 'Andhra Pradesh', cities: ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore', 'Kurnool'] },
                { name: 'Arunachal Pradesh', cities: ['Itanagar', 'Naharlagun', 'Pasighat', 'Roing', 'Tezu'] },
                { name: 'Assam', cities: ['Guwahati', 'Silchar', 'Dibrugarh', 'Jorhat', 'Nagaon'] },
                { name: 'Bihar', cities: ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Purnia'] },
                { name: 'Chhattisgarh', cities: ['Raipur', 'Bhilai', 'Bilaspur', 'Korba', 'Durg'] },
                { name: 'Goa', cities: ['Panaji', 'Vasco da Gama', 'Margao', 'Mapusa', 'Ponda'] },
                { name: 'Gujarat', cities: ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar'] },
                { name: 'Haryana', cities: ['Faridabad', 'Gurgaon', 'Panipat', 'Ambala', 'Yamunanagar'] },
                { name: 'Himachal Pradesh', cities: ['Shimla', 'Solan', 'Dharamshala', 'Kullu', 'Mandi'] },
                { name: 'Jharkhand', cities: ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro Steel City', 'Deoghar'] },
                { name: 'Karnataka', cities: ['Bangalore', 'Mysore', 'Hubli', 'Mangalore', 'Belgaum'] },
                { name: 'Kerala', cities: ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Thrissur', 'Kollam'] },
                { name: 'Madhya Pradesh', cities: ['Bhopal', 'Indore', 'Jabalpur', 'Gwalior', 'Ujjain'] },
                { name: 'Maharashtra', cities: ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik'] },
                { name: 'Manipur', cities: ['Imphal', 'Thoubal', 'Bishnupur', 'Churachandpur', 'Kakching'] },
                { name: 'Meghalaya', cities: ['Shillong', 'Tura', 'Nongstoin', 'Jowai', 'Baghmara'] },
                { name: 'Mizoram', cities: ['Aizawl', 'Lunglei', 'Saiha', 'Champhai', 'Kolasib'] },
                { name: 'Nagaland', cities: ['Kohima', 'Dimapur', 'Mokokchung', 'Tuensang', 'Wokha'] },
            ],
            localState: this.modelValueState,
            localCity: this.modelValueCity
        };
    },
    watch: {
        localState(newState) {
            this.$emit('update:modelValueState', newState);
            this.localCity = ''; // Reset city when state changes
            this.$emit('update:modelValueCity', '');
        },
        localCity(newCity) {
            this.$emit('update:modelValueCity', newCity);
        },
        modelValueState(newState) {
            this.localState = newState;
        },
        modelValueCity(newCity) {
            this.localCity = newCity;
        }
    },
    computed: {
        filteredCities() {
            if (!this.localState) {
                return [];
            }
            return this.states.find(state => state.name === this.localState).cities;
        }
    },
    methods: {
        onStateChange() {
            this.localCity = '';
        }
    }
};
</script>

<style scoped>
.state-label {
    font-weight: bold;
    margin-bottom: 5px;
}

.select-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.state-select,
.city-select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 5px;
}
</style>
