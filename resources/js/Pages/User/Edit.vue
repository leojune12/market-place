<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8">
            <div class="md:grid md:grid-cols-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Information</h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Update user's profile information and email address.
                    </p>
                </header>
            </div>
            <div class="md:grid md:grid-cols-3">
                <form @submit.prevent="submitForm()" class="mt-6 space-y-6 md:col-span-1">

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

                        <ListBox
                            id="role"
                            :items="props.roles"
                            v-on:update:model-value="form.role_id = $event.id"
                            :model-value="form.role_id"
                        />

                        <InputError class="mt-2" :message="form.errors.role_id" />
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
    import ListBox from '@/Components/ListBox.vue'
    import { ref } from 'vue'

    const props = defineProps({
        module: {
            type: String,
            required: true
        },
        moduleRoute: {
            type: String,
            required: true
        },
        model: Object,
        roles: Array,
    });

    const url = '/' + props.moduleRoute

    const form = useForm({
        first_name: props.model.first_name,
        last_name: props.model.last_name,
        email: props.model.email,
        role_id: ref(props.model.roles[0].id),
    })

    function submitForm() {
        form.patch(route(props.moduleRoute + '.update', props.model.id), {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    title: 'Success',
                    text: "Updated successfully.",
                    icon: 'success',
                    confirmButtonColor: '#16a34a',
                }).then(() => {
                    Inertia.get(url)
                })
            },
        })
    }
</script>
