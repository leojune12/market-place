<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>

        <form @submit.prevent="submitForm()" class="overflow-hidden bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8 md:col-span-2 space-y-6">
            <div class="md:grid md:grid-cols-3 md:gap-x-6 md:space-y-0 space-y-6">
                <div class="md:col-span-1">
                    <div class="">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Business Information</h3>
                        <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="name" value="Business Name" />

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
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div class="md:col-span-2">
                            <InputLabel for="name" value="Description" />

                            <TextareaInput
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                autocomplete="description"
                                rows="6"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6">
                <div class="md:col-span-1">
                    <div class="">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Address Information</h3>
                        <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">

                        <div>
                            <InputLabel for="city" value="City/Municipality in Capiz" />
                            <ListBox
                                id="city"
                                :items="citiesMunicipalities"
                                v-on:update:model-value="form.city_id = $event.id"
                            />
                            <InputError class="mt-2" :message="form.errors.city_id" />
                        </div>

                        <div>
                            <InputLabel for="barangays" value="Barangay" />
                            <ListBox
                                id="barangay"
                                :items="barangays"
                                v-on:update:model-value="form.barangay_id = $event.id"
                            />
                            <InputError class="mt-2" :message="form.errors.barangay_id" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="street" value="Street" />

                            <TextInput
                                id="street"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.street"
                                autocomplete="street"
                            />

                            <InputError class="mt-2" :message="form.errors.street" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-3 md:gap-x-6 md:space-y-0 space-y-6">
                <div class="md:col-span-1">
                    <div class="">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Information</h3>
                        <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                    </div>
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="contact_number" value="Contact Number" />

                            <TextInput
                                id="contact_number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.contact_number"
                                required
                                autocomplete="contact_number"
                            />

                            <InputError class="mt-2" :message="form.errors.contact_number" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="website" value="Website" />

                            <TextInput
                                id="website"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.website"
                                autocomplete="website"
                            />

                            <InputError class="mt-2" :message="form.errors.website" />
                        </div>
                        <div>
                            <InputLabel for="facebook_link" value="Facebook Link" />

                            <TextInput
                                id="facebook_link"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.facebook_link"
                                autocomplete="facebook_link"
                            />

                            <InputError class="mt-2" :message="form.errors.facebook_link" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="map_location" value="Map Location" />

                            <TextInput
                                id="map_location"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.map_location"
                                autocomplete="map_location"
                            />

                            <InputError class="mt-2" :message="form.errors.map_location" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-3 md:gap-x-6 md:space-y-0 space-y-6">
                <div class="md:col-span-1">
                </div>
                <div class="md:col-span-2">
                    <div class="flex flex-col md:flex-row gap-x-4 gap-y-6 md:gap-y-0">
                        <LinkComponent
                            :href="url"
                            type="secondary"
                        >
                            Back
                        </LinkComponent>
                        <PrimaryButton :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head, useForm } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import LinkComponent from '@/Components/LinkComponent.vue';
    import Swal from 'sweetalert2'
    import { ref, onMounted, watch } from 'vue'
    import ListBox from '@/Components/ListBox.vue'
    import TextareaInput from '@/Components/TextareaInput.vue';

    const props = defineProps({
        module: {
            type: String,
            required: true
        },
        moduleRoute: {
            type: String,
            required: true
        },
        roles: Array,
    });

    const citiesMunicipalities = ref([])
    const barangays = ref([])

    const url = '/' + props.moduleRoute

    const form = useForm({
        user_id: Inertia.page.props.auth.user.id,
        name: null,
        email: null,
        description: null,
        contact_number: null,
        website: null,
        facebook_link: null,
        map_location: null,
        street: null,
        barangay_id: null,
        city_id: null,
        province_id: 619,
        region_id: 6,
    })

    onMounted(() => {
        getCitiesMunicipalities()
    })

    watch(() => _.cloneDeep(form.city_id), (newValue, oldValue) => {

        getBarangays(form.city_id)
    })

    function submitForm() {
        form.post(route(props.moduleRoute + '.store'), {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    title: 'Success',
                    text: "Created successfully.",
                    icon: 'success',
                    confirmButtonColor: '#16a34a',
                }).then(() => {
                    Inertia.get(url)
                })
            },
        })
    }

    function getCitiesMunicipalities() {
        axios.get('/address/get-cities-municipalities-per-province/619')
        .then(function (response) {

            let itemsArray = []

            response.data.forEach((item) => {
                itemsArray.push({
                    id: item.citymunCode,
                    name: ucWords(item.citymunDesc)
                })
            });

            citiesMunicipalities.value = itemsArray
        })
    }

    function getBarangays(id) {
        axios.get('/address/get-barangays-per-city-muniicpality/' + id)
        .then(function (response) {

            let itemsArray = []

            response.data.forEach((item) => {
                itemsArray.push({
                    id: item.brgyCode,
                    name: ucWords(item.brgyDesc)
                })
            });

            barangays.value = itemsArray
        })
    }

    function ucWords(str) {

        return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase()
        })
    }

</script>
