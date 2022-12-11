<template>
    <div class="flex">
        <div class="w-72 flex-none md:flex hidden">
            <div class="w-72 fixed left-0 top-0 min-h-screen flex flex-col bg-slate-800 text-white h-full">
                <Link href="/" class="h-16 flex items-center px-6 border-b border-gray-700 mb-5">
                    <img class="block h-8 w-auto mr-2" src="https://tailwindui.com/img/logos/mark.svg?color=white" alt="Your Company" />
                    <div class="text-lg font-semibold">
                        Roxas Market Place
                    </div>
                </Link>
                <div class="flex flex-col px-3 gap-1">
                    <Link
                        v-for="item in navigation"
                        :href="item.href"
                        :class="[$page.url.startsWith(item.href) ? 'hover:bg-blue-500 bg-blue-500' : 'hover:bg-slate-700', 'px-3 py-2 rounded-md flex items-center']"
                    >
                        <component
                            :is="item.icon"
                            class="block h-6 w-6 mr-3"
                            aria-hidden="true"
                        />
                        {{ item.name }}
                    </Link>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="flex flex-col">
                <Disclosure as="nav" class="md:h-16 border-b" v-slot="{ open }">
                    <div class="px-2 sm:px-6 lg:px-8">
                        <div class="relative flex h-16 items-center justify-between">
                            <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                                <!-- Mobile menu button-->
                                <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                <span class="sr-only">Open main menu</span>
                                <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                                <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                                </DisclosureButton>
                            </div>
                            <div class="flex flex-1 items-center justify-center md:items-stretch md:justify-start">
                                <div class="flex flex-shrink-0 items-center">
                                <img class="block h-8 w-auto md:hidden" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                                <!-- <img class="hidden h-8 w-auto lg:block" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" /> -->
                                </div>
                                <div class="hidden md:ml-6 md:block">
                                </div>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 md:static md:inset-auto md:ml-6 md:pr-0">
                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative">
                                <div>
                                    <MenuButton class="flex items-center gap-x-2 rounded-full text-sm hover:text-gray-600 text-gray-800 focus:outline-none">
                                        <span class="sr-only">Open user menu</span>
                                        <!-- {{ $page.props.auth.user.name }} -->
                                        <img class="h-8 w-8 rounded-full hover:brightness-95" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-slot="{ active }">
                                            <Link :href="route('profile.edit')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                                Profile
                                            </Link>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <Link :href="route('logout')" method="post" as="button" :class="[active ? 'bg-gray-100' : '', 'flex px-4 py-2 text-sm text-gray-700 w-full ']">
                                                Log Out
                                            </Link>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                            </div>
                        </div>
                    </div>

                    <DisclosurePanel class="md:hidden">
                        <div class="space-y-1 px-2 pt-2 pb-3">
                            <DisclosureButton
                                v-for="item in navigation"
                                :key="item.name" as="a"
                                :href="item.href"
                                :class="[item.current ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-50', 'px-3 py-2 rounded-md text-base font-medium flex items-center']"
                                :aria-current="item.current ? 'page' : undefined"
                            >
                                <component
                                    :is="item.icon"
                                    class="block h-6 w-6 mr-3"
                                    aria-hidden="true"
                                />
                                {{ item.name }}
                            </DisclosureButton>
                        </div>
                    </DisclosurePanel>
                </Disclosure>

                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { Bars3Icon, XMarkIcon, UsersIcon, BuildingOfficeIcon, TagIcon, ShoppingBagIcon, WrenchScrewdriverIcon, BriefcaseIcon, UserCircleIcon } from '@heroicons/vue/24/outline'
    import { Link } from '@inertiajs/inertia-vue3';

    const navigation = [
        {
            name: 'Users',
            href: '/users',
            icon: UsersIcon,
        },
        {
            name: 'Categories',
            href: '/categories',
            icon: TagIcon,
        },
        {
            name: 'Businesses',
            href: '/businesses',
            icon: BuildingOfficeIcon,
        },
        {
            name: 'Products',
            href: '/products',
            icon: ShoppingBagIcon,
        },
        {
            name: 'Services',
            href: '/services',
            icon: WrenchScrewdriverIcon,
        },
        {
            name: 'Jobs',
            href: 'jobs',
            icon: BriefcaseIcon,
        },
        {
            name: 'Profile Settings',
            href: '/profile',
            icon: UserCircleIcon,
        },
    ]
</script>
