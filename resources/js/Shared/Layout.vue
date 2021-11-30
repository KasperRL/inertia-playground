<template>
  <Head>
    <title></title>
    <meta type="description" content="Information about my app" head-key="description">
  </Head>
  <section class="p-6 bg-gray-200">
    <header class="flex justify-between">
        <h1 class="text-2xl font-bold">{{ user.name }}</h1>
      <Nav />
    </header>
  </section>
  <section class="p-6">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>
</template>

<script>
import Nav from "./Nav";

export default {
  components: { Nav },

  computed: {
    user() {
      return this.$page.props.auth.user;
    },
  },
};
</script>