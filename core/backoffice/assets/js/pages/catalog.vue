<template>
  <div class="container-fluid">
    <div class="row">
      <sidebar-component />

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Catalog</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

        <h2>Catalog h2</h2>

        <div> Hi i'm the Catalog page!!</div>

      </main>
    </div>
  </div>
</template>

<script>
import SidebarComponent from '@/components/sidebar';

export default {
  name: "Catalog",
  components: {
    SidebarComponent,
  }
}
</script>

<style scoped>

</style>