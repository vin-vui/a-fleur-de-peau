<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => {
            form.reset('password');
            if (!form.hasErrors()) {
                window.location.href = '/articles';
            }
        },
    });
};
</script>

<template>
    <Head title="Log in">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=great-vibes:400|mansalva:400" rel="stylesheet" />
    </Head>

    <div class="min-h-screen bg-white py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-[#FFBF66] shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="text-[#00353F] relative px-4 py-10 bg-[#D46F4D] shadow-lg sm:rounded-3xl sm:p-20">
                <div class="text-center pb-6">
                    <h1 class="text-3xl font-[Mansalva]">CONNEXION ADMIN</h1>
                </div>

                <form @submit.prevent="submit" class="font-[Mansalva]">
                    <div class="mb-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="password" value="Mot de passe" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ms-2 text-sm text-[#00353F]">Se souvenir de moi</span>
                        </label>

                        <a v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-[#00353F] hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus-[#08C5D1]">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <div class="flex flex-col items-center mt-10">
                        <PrimaryButton class="inline-block shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            CREER UN COMPTE
                        </PrimaryButton>

                        <PrimaryButton class="inline-block mt-6 shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            SE CONNECTER
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>