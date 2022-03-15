<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4">
            <h1 class="p-4">Benvenuto in Vue.js</h1>

            <!-- <ul>
                <li v-for="i in 10 " :key="i"> 
                    {{ i }}
                </li>
            </ul>  -->

            <!-- <ExampleComponentVue></ExampleComponentVue> -->
        </div>
      
    </div>
</template>

<script>
// import ExampleComponentVue from "../components/ExampleComponent.vue";
import TheNavbar from "../components/TheNavbar.vue";
export default {
    // components: { ExampleComponentVue },
    components: { TheNavbar},
};
</script>

<style>

</style>