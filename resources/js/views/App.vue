<template>
    <div>
      <TheNavbar></TheNavbar>

        <div class="container py-4">
            <h1>Benvenut* nel Vue Blog!</h1>

            <!-- BOTTONE REFRESH -->
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" @click="fetchPosts">
                    Refresh
                </button>
            </div> 

            <!-- CARD -->
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <PostCard v-for="post of posts" :key="post.id" :post="post">
                    <!-- contenuto di ogni singola card presente nel componente -->
                </PostCard>
            </div>

            <!-- PAGINATION -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a @click="fetchPosts(pagination.current_page - 1)" class="page-link">Previous</a>
                    </li>
                    <li class="page-item" v-for="page in pagination.last_page" :key="page">
                        <a @click="fetchPosts(page)" class="page-link">{{ page }}</a>
                    </li>
                    <li class="page-item">
                        <a @click="fetchPosts(pagination.current_page + 1)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
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
            posts: [],
            pagination: {},
        };
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts(page = 1) {
            if(page < 1) {
				page = 1;
			}

			if(page > this.pagination.last_page) {
				page = this.pagination.last_page;
			}

            axios.get("/api/posts?page=" + page).then((response) => {
                this.pagination = response.data;
        	    this.posts = response.data.data;
            });
        },
    },
};
</script>

<style>

</style>