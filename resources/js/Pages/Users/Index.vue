<template>
  <Head>
    <title>Users</title>
  </Head>

  <div class="mb-6 flex justify-between">
    <div>
      <h1 class="text-3xl font-bold">Users</h1>
      <Link
        v-if="can.createUsers"
        href="/users/create"
        class="text-blue-500 text-sm"
        >New User</Link
      >
    </div>

    <input
      v-model="search"
      type="text"
      placeholder="Search..."
      class="border px-2 rounded-lg"
    />
  </div>

  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in users.data" :key="user.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div>
                      <div class="text-sm font-medium text-gray-900">
                        {{ user.name }}
                      </div>
                      <div class="text-xs text-blue-400 hover:underline">
                        <a :href="'mailto:' + user.email">{{ user.email }}</a>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="space-x-8 px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <Link v-if="can.editUsers" :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900 hover:underline">Edit</Link>
                  <Link v-if="can.deleteUsers" :href="`/users/${user.id}/delete`" as="button" method="DELETE" class="text-red-500 hover:text-red-700 hover:underline">Delete</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <Pagination :links="users.links" class="mt-6" />
</template>

<script setup>
import Pagination from "../../Shared/Pagination.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
  users: Object,
  filters: Object,
  can: Object,
});

let search = ref(props.filters.search);

watch(
  search,
  debounce(function (value) {
    console.log("Triggered.");
    Inertia.get(
      "/users",
      { search: value },
      { preserveState: true, replace: true }
    );
  }, 300)
);
</script>