<template>
  <div class="container-fluid">
    <div class="row">
      <sidebar-component />
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Ingesting</h1>
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

        <h2>Ingesting h2</h2>

        <div> Hi i'm the Ingesting page!!</div>
        <div
            v-for="concorso in concorsi"
            :key="concorso.id"

          >
            {{ concorso.titolo }}

        </div>
      </main>

      <!--      SIDEBAR 1-->
<!--      <div class="sidebar flex-shrink-0 p-3 bg-white" style="width: 280px;">-->
<!--        <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">-->
<!--          <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>-->
<!--          <span class="fs-5 fw-semibold">Collapsible</span>-->
<!--        </a>-->
<!--        <ul class="list-unstyled ps-0">-->
<!--          <li class="mb-1">-->
<!--            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">-->
<!--              Home-->
<!--            </button>-->
<!--            <div class="collapse show" id="home-collapse">-->
<!--              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">-->
<!--                <li><a href="#" class="link-dark rounded">Overview</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Updates</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Reports</a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </li>-->
<!--          <li class="mb-1">-->
<!--            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">-->
<!--              Dashboard-->
<!--            </button>-->
<!--            <div class="collapse" id="dashboard-collapse">-->
<!--              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">-->
<!--                <li><a href="#" class="link-dark rounded">Overview</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Weekly</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Monthly</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Annually</a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </li>-->
<!--          <li class="mb-1">-->
<!--            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">-->
<!--              Orders-->
<!--            </button>-->
<!--            <div class="collapse" id="orders-collapse">-->
<!--              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">-->
<!--                <li><a href="#" class="link-dark rounded">New</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Processed</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Shipped</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Returned</a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </li>-->
<!--          <li class="border-top my-3"></li>-->
<!--          <li class="mb-1">-->
<!--            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">-->
<!--              Account-->
<!--            </button>-->
<!--            <div class="collapse" id="account-collapse">-->
<!--              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">-->
<!--                <li><a href="#" class="link-dark rounded">New...</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Profile</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Settings</a></li>-->
<!--                <li><a href="#" class="link-dark rounded">Sign out</a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </li>-->
<!--        </ul>-->
<!--      </div>-->


<!--      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">-->
<!--        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">-->
<!--          <head-line-component v-bind:title="headLineTitle" />-->
<!--        </div>-->

<!--        <div-->
<!--            v-for="concorso in concorsi"-->
<!--            :key="concorso.id"-->

<!--          >-->
<!--            {{ concorso.titolo }}-->

<!--        </div>-->
<!--      </main>-->

    </div>
  </div>

</template>

<script>
  import axios from 'axios';
  import HeadLineComponent from '@/components/head-line';
  import SidebarComponent from '@/components/sidebar';
  import FakeTableComponent from '@/components/fake-table';

  export default {
    name: "Ingesting",
    components: {
      HeadLineComponent,
      SidebarComponent,
      FakeTableComponent,
    },
    data: function (){
      return {
        componentName: 'ingesting',
        headLineTitle: 'Ingesting',
        concorsi:[],
      }
    },
    async mounted() {
      const response = await axios.get('/vue-data');
      this.concorsi = response.data['concorsi'];
    },
  }
</script>

<style lang="scss" module>

</style>