<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mb-5">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Business Information</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Business details and application.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Business Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.model.name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-gray-900">
                            {{ props.model.full_address }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">User</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-blue-600 hover:underline hover:text-blue-700">
                            <a target="_blank" :href="'/users/' + props.model.user_id">
                                {{ props.model.user.first_name }} {{ props.model.user.last_name }}
                            </a>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-gray-900">
                            {{ props.model.description }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Slug</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.model.slug }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ props.model.user.email }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Contact Number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.model.contact_number }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Website</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-blue-600 hover:underline hover:text-blue-700">
                            <a target="_blank" :href="props.model.website">{{ props.model.website }}</a>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Facebook</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-blue-600 hover:underline hover:text-blue-700">
                            <a target="_blank" :href="props.model.facebook_link">
                                {{ props.model.facebook_link }}
                            </a>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Map Location</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0 text-blue-600 hover:underline hover:text-blue-700">
                            <a target="_blank" :href="props.model.map_location">
                                {{ props.model.map_location }}
                            </a>
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Created At</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.model.date_added }}</dd>
                    </div>
                </dl>
            </div>
            <div class="flex flex-col md:flex-row gap-4 py-6 sm:px-6 px-4">
                <LinkComponent
                    :href="url"
                    type="secondary"
                >
                    Back
                </LinkComponent>
                <LinkComponent
                :href="url + '/' + props.model.id + '/edit'"
                    type="primary"
                >
                    Edit
                </LinkComponent>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/inertia-vue3'
    import LinkComponent from '@/Components/LinkComponent.vue';

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
    })

    const url = '/' + props.moduleRoute
</script>
