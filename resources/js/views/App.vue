<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4">
            <h1>Vue Blog</h1>

            <!-- CARD -->
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col" v-for="post of posts" :key="post.id">
                    <div class="card my-3">
                        <img :src="getPostCover(post)" class="card-img-top" alt="post images">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text" v-html="post.content"></p>
                        </div>
                    </div>
                </div>
            </div>

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
        getPostCover(post) {
            return post.coverImg ?? 'https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126.png';
        }
    },
};
</script>

<style>

</style>