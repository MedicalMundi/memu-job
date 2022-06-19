<template>


  <div class="container-fluid">
    <div class="row">
<!--      SIDEBAR 1-->
      <div class="sidebar flex-shrink-0 p-3 bg-white" style="width: 280px;">
        <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
          <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
          <span class="fs-5 fw-semibold">Collapsible</span>
        </a>
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              Home
            </button>
            <div class="collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">Overview</a></li>
                <li><a href="#" class="link-dark rounded">Updates</a></li>
                <li><a href="#" class="link-dark rounded">Reports</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
              Dashboard
            </button>
            <div class="collapse" id="dashboard-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">Overview</a></li>
                <li><a href="#" class="link-dark rounded">Weekly</a></li>
                <li><a href="#" class="link-dark rounded">Monthly</a></li>
                <li><a href="#" class="link-dark rounded">Annually</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
              Orders
            </button>
            <div class="collapse" id="orders-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">New</a></li>
                <li><a href="#" class="link-dark rounded">Processed</a></li>
                <li><a href="#" class="link-dark rounded">Shipped</a></li>
                <li><a href="#" class="link-dark rounded">Returned</a></li>
              </ul>
            </div>
          </li>
          <li class="border-top my-3"></li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
              Account
            </button>
            <div class="collapse" id="account-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-dark rounded">New...</a></li>
                <li><a href="#" class="link-dark rounded">Profile</a></li>
                <li><a href="#" class="link-dark rounded">Settings</a></li>
                <li><a href="#" class="link-dark rounded">Sign out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <head-line-component v-bind:title="headLineTitle" />
        </div>

        <div
            v-for="concorso in concorsi"
            :key="concorso.id"

          >
            {{ concorso.titolo }}

        </div>
      </main>

    </div>
  </div>















  <!--      SIDEBAR 2-->
  <!--      <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">-->
  <!--        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">-->
  <!--          <svg class="bi" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>-->
  <!--          <span class="visually-hidden">Icon-only</span>-->
  <!--        </a>-->
  <!--        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">-->
  <!--          <li class="nav-item">-->
  <!--            <a href="#" class="nav-link active py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">-->
  <!--              <svg class="bi" width="24" height="24" role="img" aria-label="Home"><use xlink:href="#home"></use></svg>-->
  <!--            </a>-->
  <!--          </li>-->
  <!--          <li>-->
  <!--            <a href="#" class="nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">-->
  <!--              <svg class="bi" width="24" height="24" role="img" aria-label="Dashboard"><use xlink:href="#speedometer2"></use></svg>-->
  <!--            </a>-->
  <!--          </li>-->
  <!--          <li>-->
  <!--            <a href="#" class="nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">-->
  <!--              <svg class="bi" width="24" height="24" role="img" aria-label="Orders"><use xlink:href="#table"></use></svg>-->
  <!--            </a>-->
  <!--          </li>-->
  <!--          <li>-->
  <!--            <a href="#" class="nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">-->
  <!--              <svg class="bi" width="24" height="24" role="img" aria-label="Products"><use xlink:href="#grid"></use></svg>-->
  <!--            </a>-->
  <!--          </li>-->
  <!--          <li>-->
  <!--            <a href="#" class="nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">-->
  <!--              <svg class="bi" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"></use></svg>-->
  <!--            </a>-->
  <!--          </li>-->
  <!--        </ul>-->
  <!--        <div class="dropdown border-top">-->
  <!--          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">-->
  <!--            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="24" height="24">-->
  <!--          </a>-->
  <!--          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">-->
  <!--            <li><a class="dropdown-item" href="#">New project...</a></li>-->
  <!--            <li><a class="dropdown-item" href="#">Settings</a></li>-->
  <!--            <li><a class="dropdown-item" href="#">Profile</a></li>-->
  <!--            <li><hr class="dropdown-divider"></li>-->
  <!--            <li><a class="dropdown-item" href="#">Sign out</a></li>-->
  <!--          </ul>-->
  <!--        </div>-->
  <!--      </div>-->


</template>

<script>
  import axios from 'axios';
  import HeadLineComponent from "../components/head-line";

  export default {
    name: "Ingesting",
    components: {
      HeadLineComponent,
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

<style lang="scss" scoped>
@import "../../styles/component/light-component";

.sidebar {
  @include light-component;

  ul {
    li a:hover {
      background: $green-component-link-hover;
    }
  }

}
</style>