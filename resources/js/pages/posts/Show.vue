<template>
    <div>
        <h1>{{ post.title }}</h1>

        <div class="mt-3 d-flex justify-content-between align-items-center">
            <div class="post-infos">
                <span v-if="post.category" class="bg-success rounded p-1 mr-2 text-white"> 
                    {{ post.category.code }}
                </span>

                <span
                    v-for="tag in post.tags"
                    :key="tag.id"
                    class="bg-warning rounded mr-2"
                    >
                    {{ tag.name }}
                </span>
            </div>

            <em v-if="post.user">{{ post.user.name }}</em>
        </div>

        <div class="d-flex flex-column">
                <div></div>
                <img :src="post.coverImg" class="post-img img-fluid my-3 align-self-center" style="width: 600px" alt="">

                <h3>Contenuto del post</h3> 
                <div v-html="post.content"></div>
        </div>
    
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