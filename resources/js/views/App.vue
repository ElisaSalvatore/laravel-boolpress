<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4">
            <h1 class="p-4">Benvenuto in Vue.js</h1>
        </div>
      
    </div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";
import axios from "axios";

export default {
    components: {TheNavbar},
    data() {
        return {
            posts: []
        }
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts() {
            axios.get("/api/posts").then((response) => {
			    this.posts = response.data;
		    });
        },
    },
};
</script>

<style>

</style>