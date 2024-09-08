<script setup>
import {Head, Link} from "@inertiajs/vue3";
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";

defineProps(['users'])
</script>

<template>
    <Head title="Users"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
            <h1>Users</h1>
            <Link :href="route('users.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New User</Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>
                                Name
                            </TableHeaderCell>
                            <TableHeaderCell>
                                Email
                            </TableHeaderCell>
                            <TableHeaderCell>
                                Action
                            </TableHeaderCell>
                        </TableRow>
                    </template>

                    <template #default>
                        <TableRow :key="user.id" v-for="user in users" class="border-b">
                            <TableDataCell>
                                {{user.id}}
                            </TableDataCell>
                            <TableDataCell>
                                {{user.name}}
                            </TableDataCell>
                            <TableDataCell>
                                {{user.email}}
                            </TableDataCell>
                            <TableDataCell class="space-x-2">
                                <Link :href="route('users.edit', user.id)" class="text-green-400 hover:text-green-600">Edit</Link>

                                <Link :href="route('users.destroy', user.id)" class="text-red-400 hover:text-red-600" method="DELETE" as="button">Delete</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
