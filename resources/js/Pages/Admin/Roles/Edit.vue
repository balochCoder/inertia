<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import VueMultiselect from "vue-multiselect";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableRow from "@/Components/TableRow.vue";
import Table from "@/Components/Table.vue";
import {onMounted, watch} from "vue";

const props = defineProps({
    role: {
        type: Object,
        required: true
    },
    permissions: Array
})

const form = useForm({
    name: props.role.name,
    permissions: []
});

onMounted(()=>{
    form.permissions = props.role?.permissions
})

watch(() => props.role,()=> (form.permissions  = props.role?.permissions))
</script>
<template>
    <Head title="Update Role"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-end">
                <Link :href="route('roles.index')"
                      class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                    Back
                </Link>
            </div>
            <div class="mt-6 w-full mx-auto bg-slate-100 shadow-lg rounded-lg p-4">
                <h1 class="text-2xl p-4">Edit Role</h1>
                <form @submit.prevent="form.put(route('roles.update', props.role.id))">
                    <div class="mt-4">
                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions"/>

                        <VueMultiselect
                            v-model="form.permissions"
                            :options="permissions"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Select Permissions"
                            label="name"
                            track-by="id"
                        />
                    </div>
                    <div class="flex items-center mt-4">

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>
                                ID
                            </TableHeaderCell>
                            <TableHeaderCell>
                                Name
                            </TableHeaderCell>
                            <TableHeaderCell>
                                Action
                            </TableHeaderCell>
                        </TableRow>
                    </template>

                    <template #default>
                        <TableRow :key="rolePermission.id" v-for="rolePermission in props.role?.permissions" class="border-b">
                            <TableDataCell>
                                {{ rolePermission.id }}
                            </TableDataCell>
                            <TableDataCell>
                                {{ rolePermission.name }}
                            </TableDataCell>
                            <TableDataCell class="space-x-2">


                                <Link :href="route('roles.permissions.destroy', [role.id, rolePermission.id])"
                                      class="text-red-400 hover:text-red-600" method="DELETE" as="button">Revoke
                                </Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
