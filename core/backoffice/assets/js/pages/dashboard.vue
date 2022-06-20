<template>
  <div class="container-fluid">
    <div class="row">
      <sidebar-component />
      <div> Hi i'm the Dashbord page</div>
    </div>
  </div>

</template>

<script>
import SidebarComponent from "../components/sidebar";

export default {
  name: "Dashboard",
  components: {
    SidebarComponent,
  }
}
</script>

<style scoped>

</style>