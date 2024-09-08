<script setup>
import {Head, Link} from "@inertiajs/vue3";
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";

defineProps(['roles'])
</script>

<template>
    <Head title="Roles"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Roles</h1>
                <Link :href="route('roles.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New Role</Link>
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
                                Action
                            </TableHeaderCell>
                        </TableRow>
                    </template>

                    <template #default>
                        <TableRow :key="role.id" v-for="role in roles" class="border-b">
                            <TableDataCell>
                                {{role.id}}
                            </TableDataCell>
                            <TableDataCell>
                                {{role.name}}
                            </TableDataCell>
                            <TableDataCell class="space-x-2">
                                <Link :href="route('roles.edit', role.id)" class="text-green-400 hover:text-green-600">Edit</Link>

                                <Link :href="route('roles.destroy', role.id)" class="text-red-400 hover:text-red-600" method="DELETE" as="button">Delete</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
