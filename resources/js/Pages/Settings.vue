<template>
  <Head>
    <title>Settings</title>
  </Head>

  <h1 class="text-3xl font-bold">Settings</h1>

  <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
    <div class="mb-6">
      <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name *</label>
      <input v-model="form.name" type="text" name="name" id="name" class="border border-gray-400 p-2 w-full" required>
      <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 mt-1 text-xs"></div>
    </div>
    <div class="mb-6">
      <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email *</label>
      <input v-model="form.email" type="email" name="email" id="email" class="border border-gray-400 p-2 w-full" required>
      <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 mt-1 text-xs"></div>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
      <input v-model="form.password" type="password" name="password" id="password" class="border border-gray-400 p-2 w-full">
      <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 mt-1 text-xs"></div>
    </div>
    <div class="mb-6">
      <label for="repeated_password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Repeat Password</label>
      <input v-model="form.repeated_password" type="password" name="repeated_password" id="repeated_password" class="border border-gray-400 p-2 w-full">
      <div v-if="form.errors.repeated_password" v-text="form.errors.repeated_password" class="text-red-500 mt-1 text-xs"></div>
    </div>
    <div v-if="form.isDirty" class="mb-6">
      <p class="italic text-sm">There are unsaved changes.</p>
    </div>
    <input v-model="form.userId" type="hidden" id="userId" name="userId">
    <div class="mb-6">
      <button type="submit" class="bg-red-500 text-white rounded py-2 px-4 hover:bg-red-600" :disabled="form.processing">
          Save
      </button>
    </div>
  </form>

</template>

<script setup>
  import { useForm } from "@inertiajs/inertia-vue3";

  let props = defineProps({
    user: Object,
  })

  let form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    repeated_password: '',
    userId: props.user.id,
  });

  let submit = () => {
    form.post('/settings');
  };
</script>
