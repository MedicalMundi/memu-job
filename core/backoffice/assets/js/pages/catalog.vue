<template>
  <div class="container-fluid">
    <div class="row">
      <sidebar-component />
      <div> Hi i'm the Catalog page!!</div>
    </div>
  </div>
</template>

<script>
import SidebarComponent from "../components/sidebar";

export default {
  name: "Catalog",
  components: {
    SidebarComponent,
  }
}
</script>

<style scoped>

</style>