<template>
  <Link
    class="hover:underline"
    :class="{ 'font-bold underline': active }"
    ><slot /></Link
  >
</template>

<script>
export default {
  props: {
    active: Boolean,
  },
};
</script>