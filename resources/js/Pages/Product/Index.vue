<template>
    <Head :title="props.module" />

    <AuthenticatedLayout>
        <div class="flex flex-col md:flex-row mb-4 md:justify-between md:items-center gap-y-4">
            <h3 class="text-xl font-bold leading-6 text-gray-700">
                {{ props.module }}
            </h3>
            <LinkComponent
                :href="url + '/create'"
                type="success"
                class=""
            >
                <PlusIcon class="block h-5 w-5" aria-hidden="true" />
                Create
            </LinkComponent>
        </div>
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full">
                <thead class="border bg-sky-600 text-sm font-medium text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">
                            ID
                        </th>
                        <th class="py-3 px-6 text-left">
                            Name
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
                            {{ item.name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-3 whitespace-nowrap">
                            <div class="flex gap-2">
                                <Link
                                    :href="url + '/' + item.id"
                                    class="text-green-500 hover:text-green-600 transition duration-300 ease-in-out"
                                    title="View"
                                >
                                    <EyeIcon class="block h-5 w-5" aria-hidden="true" />
                                </Link>
                                <Link
                                    :href="url + '/' + item.id + '/edit'"
                                    class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                                    title="Edit"
                                >
                                    <PencilSquareIcon class="block h-5 w-5" aria-hidden="true" />
                                </Link>
                                <a
                                    href="#"
                                    class="text-red-500 hover:text-red-600 transition duration-300 ease-in-out"
                                    title="Delete"
                                    @click="confirmDelete(item.id)"
                                >
                                    <TrashIcon class="block h-5 w-5" aria-hidden="true" />
                                </a>
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
            :url="url"
        />
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PaginationComponent from '@/Components/Table/Pagination.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { EyeIcon, PencilSquareIcon, TrashIcon, PlusIcon } from '@heroicons/vue/24/outline'
    import Swal from 'sweetalert2'
    import { useForm } from '@inertiajs/inertia-vue3'
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
        response: Object,
    })

    const url = '/' + props.moduleRoute

    const form = useForm({
        //
    })

    function confirmDelete(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteItem(id)
            }
        })
    }

    function deleteItem(id) {

        let id_array = Array.isArray(id)
                    ? Object.keys(id).map(index => id[index].id)
                    : [id]

        form.transform(() => ({
                id_array: id_array,
            }))
            .delete(
            route(props.moduleRoute + '.destroy', id),
            {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success',
                        text: "Deleted successfully.",
                        icon: 'success',
                        confirmButtonColor: '#16a34a',
                    })
                },
                onError: (error) => {
                    Swal.fire({
                        title: 'Something went wrong',
                        text: "Please refresh the page.",
                        icon: 'error',
                        confirmButtonColor: '#d33',
                    })
                },
            }
        )
    }

</script>
