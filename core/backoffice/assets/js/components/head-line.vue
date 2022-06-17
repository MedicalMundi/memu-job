<template>
  <h1 class="head-line">{{ title }}</h1>
</template>

<script>
  export default {
    name: "HeadLine",
    props: {
      title: {
        type: String,
        required: true,
      }
    },
  };
</script>

<style scoped>

</style>