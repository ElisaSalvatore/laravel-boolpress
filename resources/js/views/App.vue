<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4 vh-100">

            <router-view></router-view>

        </div>

        <TheFooter></TheFooter>
    </div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";
import TheFooter from "../components/TheFooter.vue";


export default {
    components: {TheNavbar, TheFooter},
};
</script>

<style lang="scss" scoped></style>
