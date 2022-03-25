<template>
    <div class="infos d-flex flex-column justify-content-between">
        <h1>{{ post.title }}</h1>
       
        <img :src="post.coverImg" class="post-img img-fluid my-3 align-self-center" style="width: 600px" alt="">

        <h3>Contenuto del post</h3> 
        <div v-html="post.content"></div>
    
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
            try {
                const response = await axios.get("/api/posts/" + this.$route.params.post);

                this.post = response.data;
            } catch (error) {
                this.$router.replace({name: "error"})
            }
        }
    },
    mounted() {
        this.fetchPost();
    }
}
</script>

<style lang="scss" scoped></style>