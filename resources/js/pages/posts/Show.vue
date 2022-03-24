<template>
    <div class="infos">
        <h1>{{ post.title }}</h1>
        
        <img :src="post.coverImg" class="rounded mx-auto my-4 d-block" alt="">

        <div v-html="post.content" class="fs-2 mb-2 text-center"></div>
    
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            post: {},
        }
    },
    methods: {
        async fetchPost() {
            const response = await axios.get("/api/posts/" + this.$route.params.post);

            this.post = response.data;
        }
    },
    mounted() {
        this.fetchPost();
    }
}
</script>

<style lang="scss" scoped>
    .infos {
        img {
            width: 780px;
            height: 450px;
        }
    }
</style>