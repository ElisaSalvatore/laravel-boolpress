<template>
    <div>
        <h1 class="my-2">{{ post.title }}</h1>

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

    
        <img :src="post.coverImg" class="post-img img-fluid mt-3" alt="">

        <h3 class="mt-4">Contenuto del post</h3> 
        <div v-html="post.content" class="lead"></div>

        <h5 class="mt-4">Data creazione</h5>
        <div>{{ createdAt }}</div>
        
        <h5 class="mt-4">Data ultima modifica</h5>
        <div>{{ updatedAt }}</div>
    
    </div>
</template>

<script>
import axios from "axios";
import dayjs from 'dayjs';

export default {
    data() {
        return {
            post: {},
        }
    },
    computed: {
        createdAt() {
            return dayjs(this.post.created_at).format("DD/MM/YY HH:mm");
        },
        updatedAt() {
            return dayjs(this.post.updated_at).format("DD/MM/YY HH:mm");
        },
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

<style lang="scss" scoped>
.post-img {
  width: 100%;
  max-height: 450px;
  object-fit: cover;
}
</style>