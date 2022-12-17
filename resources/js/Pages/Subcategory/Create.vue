<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8">
            <div class="md:grid md:grid-cols-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Subcategory Information</h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create subcategory's information and email address.
                    </p>
                </header>
            </div>
            <div class="">
                <form @submit.prevent="submitForm()" class="mt-6 space-y-6">

                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
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
                        <div>
                            <InputLabel for="category" value="Category" />
                            <ListBox
                                id="category"
                                :items="props.categories"
                                v-on:update:model-value="form.category_id = $event.id"
                            />
                            <InputError class="mt-2" :message="form.errors.category_id" />
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
    import ListBox from '@/Components/ListBox.vue'

    const props = defineProps({
        module: {
            type: String,
            required: true
        },
        moduleRoute: {
            type: String,
            required: true
        },
        categories: {
            type: Array,
            required: true,
        }
    });

    const url = '/' + props.moduleRoute

    const form = useForm({
        name: null,
        category_id: null,
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
