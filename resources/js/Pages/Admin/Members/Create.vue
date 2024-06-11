<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        AppLayout,
        InputError
    },
    methods: {
        memberCreate() {
            if (this.$refs.photo) {
                if (this.$refs.photo.files[0] !== undefined) {
                    this.form.profile_picture = this.$refs.photo.files[0];
                }
            }
            this.form.post(route('members.store'), {
                preserveState: (page) => Object.keys(page.props.errors).length
            });
        },
        previewImg(e) {
            this.previewImage = URL.createObjectURL(e.target.files[0]);
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                role: '',
                description: '',
                profile_picture: null,
            }),
            previewImage: '',
        };
    },
}
</script>

<template>
    <AppLayout title="Create">
        <template #header>
            <h1 class="font-mansalva font-semibold text-xl text-[#00353F] leading-tight">
                CREER UN MEMBRE
            </h1>
        </template>

        <div class="min-h-screen bg-white py-1 sm:py-12">
            <div class="relative sm:max-w-xl sm:mx-auto bg-white shadow-lg sm:rounded-3xl sm:p-20">

                <form @submit.prevent="memberCreate" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-[#00353F] mb-2" for="name">Nom</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text"
                            v-model="form.name"
                            name="name"
                            id="name"
                            required/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[#00353F] mb-2" for="role">Rôle</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text"
                            v-model="form.role"
                            name="role"
                            id="role"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block text-[#00353F] mb-2" for="description">Description</label>
                        <textarea
                            class="shadow min-h-0 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="form.description"
                            name="description"
                            id="description"
                            style="height: 121px"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[#00353F] mb-2" for="profile_picture">Photo de profil</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="file"
                            ref="photo"
                            @change="previewImg" accept="image/jpeg, image/png, image/svg, image/webp"
                            name="profile_picture"
                            id="profile_picture"/>
                        <div class="mb-4 flex justify-center">
                            <img v-if="previewImage" :src="previewImage" alt="" class="max-w-full h-auto">
                        </div>
                        <InputError :message="form.errors.profile_picture" />
                    </div>

                    <div class="flex justify-between">
                        <button
                            class="shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Créer
                        </button>
                        <button
                            class="shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="reset"
                        >
                            Réinitialiser
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>