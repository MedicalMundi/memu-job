<template>
<!--  <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block bg-light collapse">-->
  <nav id="sidebarMenu"
       :class="[$style.sidebar, 'col-md-3','col-lg-2','d-md-block','bg-light','collapse']"
        >
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/backoffice/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/backoffice/ingesting">
            <span data-feather="file"></span>
            Ingesting RSS
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/backoffice/catalog">
            <span data-feather="file"></span>
            Catalog
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/backoffice/publishing">
            <span data-feather="file"></span>
            CMS
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file"></span>
            Backoffice
          </a>
        </li>

<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="file"></span>-->
<!--            Orders-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="shopping-cart"></span>-->
<!--            Products-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="users"></span>-->
<!--            Customers-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="bar-chart-2"></span>-->
<!--            Reports-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="layers"></span>-->
<!--            Integrations-->
<!--          </a>-->
<!--        </li>-->
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="file-text"></span>-->
<!--            Current month-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="file-text"></span>-->
<!--            Last quarter-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="file-text"></span>-->
<!--            Social engagement-->
<!--          </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a class="nav-link" href="#">-->
<!--            <span data-feather="file-text"></span>-->
<!--            Year-end sale-->
<!--          </a>-->
<!--        </li>-->
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Sidebar"
}
</script>

<style lang="scss" module>
@import '~styles/component/light-component';

.sidebar {
  @include light-component;

ul {
li a:hover {
  background: $green-component-link-hover;
}
}

}

</style>