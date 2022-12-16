<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8">
            <div class="md:grid md:grid-cols-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Information</h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create user's profile information and email address.
                    </p>
                </header>
            </div>
            <div class="">
                <form @submit.prevent="submitForm()" class="mt-6 space-y-6">

                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="first_name" value="First Name" />

                            <TextInput
                                id="first_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.first_name"
                                required
                                autofocus
                                autocomplete="first_name"
                            />

                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>

                        <div>
                            <InputLabel for="last_name" value="Last Name" />

                            <TextInput
                                id="last_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.last_name"
                                required
                                autocomplete="last_name"
                            />

                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
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
                            <InputLabel for="role" value="Role" />

                            <select
                                v-model="form.role"
                                id="country"
                                name="country"
                                autocomplete="country-name"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm h-10 capitalize"
                            >
                                <option value="null">Select Role</option>
                                <option
                                    v-for="role in props.roles"
                                    :key="role.id"
                                    :value="role.name"
                                    class="capitalize"
                                >
                                    {{ role.name }}
                                </option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.role" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Confirm Password" />

                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="password_confirmation"
                            />

                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4">
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
                </form>
            </div>
        </div>
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

    const url = '/' + props.moduleRoute

    const form = useForm({
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        password_confirmation: null,
        role: null,
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
</script>
