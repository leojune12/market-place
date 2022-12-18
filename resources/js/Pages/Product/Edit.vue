<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="bg-white shadow sm:rounded-lg mb-5 p-4 sm:p-8">
            <div class="md:grid md:grid-cols-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Category Information</h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Update category's profile information and email address.
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
                            <InputLabel for="business" value="Business" />
                            <ListBox
                                id="business"
                                :items="businesses"
                                v-on:update:model-value="form.business_id = $event.id"
                                :model-value="form.business_id"
                            />
                            <InputError class="mt-2" :message="form.errors.business_id" />
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
                        <div class="md:col-span-2">
                            <InputLabel for="name" value="Description" />

                            <TextareaInput
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                autocomplete="description"
                                rows="6"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
                        <div>
                            <InputLabel for="price" value="Price" />

                            <TextInput
                                id="price"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.price"
                                required
                                autocomplete="price"
                            />

                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-3 md:gap-x-6 space-y-6 md:space-y-0">
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
    import TextareaInput from '@/Components/TextareaInput.vue'
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
        model: Object,
        businesses: {
            type: Array,
        }
    });

    const url = '/' + props.moduleRoute

    const form = useForm({
        name: props.model.name,
        business_id: props.model.business_id,
        description: props.model.description,
        price: props.model.price,
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
