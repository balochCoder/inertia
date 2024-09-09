<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import VueMultiselect from "vue-multiselect";
import {onMounted, watch} from "vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableRow from "@/Components/TableRow.vue";
import Table from "@/Components/Table.vue";

const props = defineProps({
    user:{
        type: Object,
        required:true
    },
    roles:{
        type: Array
    },
    permissions:{
        type:Array
    }
})
const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    roles:[],
    permissions:[]
});



const submit = () => {
    form.put(route('users.update', props.user?.id),{
        preserveScroll: true
    });
};
onMounted(() => {
    form.roles = props.user?.roles
    form.permissions = props.user?.permissions
})
watch(() => props.user,()=> {
    form.roles  = props.user?.roles
    form.permissions = props.user?.permissions
})


</script>
<template>
    <Head title="Edit User"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-end">
                <Link :href="route('users.index')"
                      class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                    Back
                </Link>
            </div>
            <div class="mt-6 w-full mx-auto bg-slate-100 shadow-lg rounded-lg p-4">
                <h1 class="text-2xl p-4">Update User</h1>
                <form @submit.prevent="submit">
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
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="roles" value="Roles"/>

                        <VueMultiselect
                            v-model="form.roles"
                            :options="roles"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Select Roles"
                            label="name"
                            track-by="id"
                        />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions"/>

                        <VueMultiselect
                            v-model="form.permissions"
                            :options="permissions"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Select Permissions
"
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
                <div>
                    <h1>Roles</h1>
                </div>
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
                        <TableRow :key="userRole.id" v-for="userRole in props.user?.roles" class="border-b">
                            <TableDataCell>
                                {{ userRole.id }}
                            </TableDataCell>
                            <TableDataCell>
                                {{ userRole.name }}
                            </TableDataCell>
                            <TableDataCell class="space-x-2">


                                <Link :href="route('users.roles.destroy',[props.user?.id, userRole?.id])"
                                      class="text-red-400 hover:text-red-600" method="DELETE" as="button"
                                      preserve-scroll
                                >
                                    Revoke
                                </Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
            <div class="mt-6">
                <div>
                    <h1>Permissions</h1>
                </div>
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
                        <TableRow :key="userPermission.id" v-for="userPermission in props.user?.permissions" class="border-b">
                            <TableDataCell>
                                {{ userPermission.id }}
                            </TableDataCell>
                            <TableDataCell>
                                {{ userPermission.name }}
                            </TableDataCell>
                            <TableDataCell class="space-x-2">


                                <Link :href="route('users.permissions.destroy',[props.user?.id, userPermission?.id])"
                                      class="text-red-400 hover:text-red-600" method="DELETE" as="button"
                                      preserve-scroll
                                >
                                    Revoke
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

