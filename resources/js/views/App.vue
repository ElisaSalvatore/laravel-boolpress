<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4">
            <h1>Benvenut* nel Vue Blog!</h1>

            <!-- CARD -->
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <PostCard v-for="post of posts" :key="post.id" :post="post">
                    <!-- contenuto di ogni singola card presente nel componente -->
                </PostCard>
            </div>

        </div>
    </div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";
import axios from "axios";
import PostCard from "../components/PostCard.vue";

export default {
    components: {TheNavbar, PostCard},
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