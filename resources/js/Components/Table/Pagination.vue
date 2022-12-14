<template>
    <div class="flex flex-col md:flex-row items-center justify-between gap-y-3">
        <div class="flex gap-x-6 flex-col md:flex-row gap-y-3">
            <ul class="flex items-center">
                <li class="flex items-center">
                    <button
                        type="button"
                        @click="onClickFirstPage"
                        :disabled="isInFirstPage"
                        :class="[isInFirstPage ? 'pointer-events-none text-gray-500' : 'text-gray-700', 'relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-3 h-10 text-sm font-medium hover:bg-gray-100 focus:z-20']"
                        title="Last"
                    >
                        <ChevronDoubleLeftIcon
                            class="block h-4 w-4"
                            aria-hidden="true"
                        />
                    </button>
                </li>

                <li class="flex items-center">
                    <button
                        type="button"
                        @click="onClickPreviousPage"
                        :disabled="isInFirstPage"
                        :class="[isInFirstPage ? 'pointer-events-none text-gray-500' : 'text-gray-700', 'relative inline-flex items-center border border-gray-300 bg-white px-3 h-10 text-sm font-medium hover:bg-gray-100 focus:z-20']"
                        title="Previous"
                    >
                        <ChevronLeftIcon
                            class="block h-4 w-4"
                            aria-hidden="true"
                        />
                    </button>
                </li>

                <!-- Visible Buttons Start -->

                <li
                    v-for="page in pages"
                    :key="page.name"
                    >
                    <button
                        type="button"
                        :disabled="page.isDisabled"
                        @click="onClickPage(page.name)"
                        :class="[page.isDisabled ? 'border-blue-500 bg-blue-50 text-blue-600 z-20' : 'bg-white text-gray-700 hover:bg-gray-100 border-gray-300', 'relative inline-flex items-center border px-4 h-10 text-sm font-medium m-0']"
                    >
                        {{ page.name }}
                    </button>
                </li>

                <!-- Visible Buttons End -->

                <li class="flex items-center">
                    <button
                        type="button"
                        @click="onClickNextPage"
                        :disabled="isInLastPage"
                        :class="[isInLastPage ? 'pointer-events-none text-gray-500' : 'text-gray-700', 'relative inline-flex items-center border border-gray-300 bg-white px-3 h-10 text-sm font-medium hover:bg-gray-100 focus:z-20']"
                        title="Next"
                    >
                        <ChevronRightIcon
                            class="block h-4 w-4"
                            aria-hidden="true"
                        />
                    </button>
                </li>

                <li class="flex items-center">
                    <button
                        type="button"
                        @click="onClickLastPage"
                        :disabled="isInLastPage"
                        :class="[isInLastPage ? 'pointer-events-none text-gray-500' : 'text-gray-700', 'relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-3 h-10 text-sm font-medium hover:bg-gray-100 focus:z-20']"
                        title="Last"
                    >
                        <ChevronDoubleRightIcon
                            class="block h-4 w-4"
                            aria-hidden="true"
                        />
                    </button>
                </li>
            </ul>
            <div class="flex items-center justify-center gap-x-2">
                <label for="per_page" class="block text-sm font-medium text-gray-700 whitespace-nowrap">Per Page</label>
                <select
                    v-model="currentPerPage.value"
                    id="per_page"
                    name="per_page"
                    autocomplete="per_page"
                    class="block w-full rounded-md border border-gray-300 bg-white h-10 pl-3 pr-8 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm text-gray-700 w-16"
                    @change="queryTable(false, true)"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
        <div>
            <p class="text-sm text-gray-700">
                Showing
                {{ ' ' }}
                <span class="font-medium">
                    {{ from }}
                </span>
                {{ ' ' }}
                to
                {{ ' ' }}
                <span class="font-medium">
                    {{ to }}
                </span>
                {{ ' ' }}
                of
                {{ ' ' }}
                <span class="font-medium">
                    {{ total }}
                </span>
                {{ ' ' }}
                results
            </p>
        </div>
    </div>
</template>

<script>
import { ChevronDoubleLeftIcon, ChevronLeftIcon, ChevronDoubleRightIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'
    export default {
        components: {
            ChevronDoubleLeftIcon,
            ChevronLeftIcon,
            ChevronDoubleRightIcon,
            ChevronRightIcon,
        },
        props: {
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 3
            },
            totalPages: {
                type: Number,
                required: true
            },
            perPage: {
                type: Number,
                required: true
            },
            currentPage: {
                type: Number,
                required: true
            },
            from: {
                type: Number,
                required: true
            },
            to: {
                type: Number,
                required: true
            },
            total: {
                type: Number,
                required: true
            },
            url: {
                type: String,
                required: true,
            },
        },
        computed: {
            startPage() {
                // When on the first page
                if (this.currentPage === 1) {
                    return 1;
                }

                // When on the last page
                if (this.currentPage === this.totalPages) {
                    const start = this.totalPages - (this.maxVisibleButtons - 1);

                    if (start === 0) {
                        return 1;
                    } else {
                        return start;
                    }
                }

                // When inbetween
                return this.currentPage - 1

                // When inbetween
                // let tempCurrentPage = this.currentPage

                // if (tempCurrentPage - 2 < 1) {
                //     return this.currentPage - 1
                // } else {
                //     return this.currentPage - 2;
                // }
            },
            pages() {
                const range = [];

                for (
                    let i = this.startPage;
                    i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                    i++
                ) {
                    range.push({
                        name: i,
                        isDisabled: i === this.currentPage
                    });
                }

                return range;
            },
            isInFirstPage() {
                return this.currentPage === 1;
            },
            isInLastPage() {
                return this.currentPage === this.totalPages;
            },
        },
        data() {
            return {
                currentPerPage: {
                    value: 10
                },
                queryString: ''
            }
        },
        mounted() {
            this.currentPerPage.value = JSON.parse(JSON.stringify(this.perPage))
        },
        methods: {
            onClickFirstPage() {
                this.queryTable(1)
            },
            onClickPreviousPage() {
                this.queryTable(this.currentPage - 1)
            },
            onClickPage(page) {
                this.queryTable(page)
            },
            onClickNextPage() {
                this.queryTable(this.currentPage + 1)
            },
            onClickLastPage() {
                this.queryTable(this.totalPages)
            },
            queryTable(page = false, perPageChanged = false) {

                if (!page) {
                    page = this.currentPage
                }

                if (perPageChanged) {
                    page = 1
                }

                this.queryString = '?page=' + page + '&perPage=' + this.currentPerPage.value

                let query = this.url + this.queryString

                this.$inertia.get(
                    query,
                    {},
                    { preserveScroll: true }
                )
            },
        }
    };
</script>
