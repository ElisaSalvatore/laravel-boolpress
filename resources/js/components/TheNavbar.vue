<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/">Laravel Boolpress</a>
       
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!--  Left Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- <li class="nav-item">
              <router-link :to="({ name: 'contacts.index' })" class="nav-link mx-2"> Contatti </router-link>
            </li> -->
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <li v-for="route in routes" :key="route.path" class="nav-item">
              <router-link :to="route.path" class="nav-link">
                {{ route.meta.linkText }} 
              </router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login"> Area privata </a>
            </li>
          </ul>
        </div> 
      </div>
    </nav>
  </div>
</template>

<script>

export default {
  data() {
    return {
      routes: [],
    }
  },
  mounted() {
    // per filtrare le rotte che contengono un linkText 
    this.routes = this.$router.getRoutes().filter((route) => route.meta.linkText !== undefined);
  },
};
</script>

<style lang="scss" scoped></style>