<template>
  <div class="container-fluid">
    <div class="row">
      <sidebar-component />
      <div> Hi i'm the Publishing page!!</div>
    </div>
  </div>
</template>

<script>
import SidebarComponent from "../components/sidebar";

export default {
  name: "Publishing",
  components: {
    SidebarComponent,
  }
}
</script>

<style scoped>

</style>