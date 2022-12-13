<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full">
                <thead class="border bg-slate-600 text-sm font-medium text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">
                            ID
                        </th>
                        <th class="py-3 px-6 text-left">
                            First Name
                        </th>
                        <th class="py-3 px-6 text-left">
                            Last Name
                        </th>
                        <th class="py-3 px-6 text-left">
                            Email
                        </th>
                        <th class="py-3 px-6 text-left">
                            Role
                        </th>
                        <th class="py-3 px-6 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr
                        v-for="item in response.data"
                        :key="item.id"
                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
                    >
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ item.id }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap">
                            {{ item.first_name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap">
                            {{ item.last_name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap">
                            {{ item.email }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap capitalize">
                            {{ item.role_name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap">
                            <div class="flex gap-2">
                                <Link
                                    :href="'/users/' + item.id"
                                    class="text-green-500 hover:text-green-600 transition duration-300 ease-in-out"
                                    title="View"
                                >
                                    <EyeIcon class="block h-5 w-5" aria-hidden="true" />
                                </Link>
                                <Link
                                    :href="'/users/' + item.id + '/edit'"
                                    class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                                    title="Edit"
                                >
                                    <PencilSquareIcon class="block h-5 w-5" aria-hidden="true" />
                                </Link>
                                <Link
                                    href="#"
                                    class="text-red-500 hover:text-red-600 transition duration-300 ease-in-out"
                                    title="Delete"
                                >
                                    <TrashIcon class="block h-5 w-5" aria-hidden="true" />
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <PaginationComponent
            :totalPages="response.last_page"
            :perPage="response.per_page"
            :currentPage="response.current_page"
            :from="response.from"
            :to="response.to"
            :total="response.total"
            url="/users"
        />
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PaginationComponent from '@/Components/Table/Pagination.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { EyeIcon, PencilSquareIcon, TrashIcon, ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'

    export default {
        components: {
            AuthenticatedLayout,
            PaginationComponent,
            Head,
            Link,
            EyeIcon,
            PencilSquareIcon,
            TrashIcon,
            ChevronLeftIcon,
            ChevronRightIcon,
        },
        props: {
            response: Object,
        },
    }

</script>
