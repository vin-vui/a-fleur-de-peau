<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout
    },
    props: {
        members: Array,
    },
    methods: {
        memberCreate() {
            this.$inertia.visit(route('members.create'));},
        memberVisit(member) {
            this.$inertia.visit(route('members.edit', member.id));},
            memberDelete(member) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) {
                this.$inertia.delete(route('members.destroy', member.id));
            }
        },
    }
}
</script>

<template>
    <AppLayout title="Index">
        <template #header>
            <h1 class="font-mansalva font-semibold text-xl text-[#00353F] leading-tight">
                GESTION DES MEMBRES DE L'ASSOCIATION
            </h1>
        </template>

        <div>

            <h2 class="my-4 ml-8">Membres existants :</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Rôle</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Photo de profil</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="member in members" :key="member.id" class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b text-center">{{ member.name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ member.role }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ member.description }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <img :src="member.profile_picture" alt="Photo de profil" class="max-w-sm mx-auto">
                        </td>
                        <td class="py-2 px-4 border-b flex justify-center space-x-2">
                            <button class="bg-[#FFBF66] text-black rounded-md py-1 px-3" @click="memberVisit(member)">
                                Modifier
                            </button>
                            <button class="bg-[#D46F4D] text-white rounded-md py-1 px-3" @click="memberDelete(member)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="bg-[#00353F] text-slate-100 rounded-md py-2 px-4 mt-6 ml-6" @click="memberCreate">
                Créer un nouveau membre
            </button>

        </div>
    </AppLayout>
</template>