<template>
    <div class="col">
        <div class="card my-3">
            <img :src="getPostCover(post)" class="card-img-top" alt="post images">
            
            <div class="card-body">
                <div class="py-2">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text" v-html="post.content"></p>
                </div>
            
                <!-- Autore e data -->
                <div class="py-2">
                    Autore: <em class="mr-2">{{ post.user.name }} </em>
                    Data: <em>{{ formatDate(post.created_at) }}</em>
                </div>

                <br>

                <!-- Categoria -->
                <div v-if="post.category" class="d-inline mb-2 mr-2">
                    <span class="badge bg-success rounded p-1 text-white">
                        {{ post.category.code }}
                    </span>
                </div>

                <!-- Tags -->
                <div v-if="post.tags" class="d-inline">
                    <span
                        v-for="tag in post.tags"
                        :key="tag.id"
                        class="badge bg-warning rounded p-1 mr-2"
                        > 
                        {{ tag.name }}
                    </span>
                </div>

            </div>

            <!-- LINK DETTAGLI -->
            <div class="card-footer d-flex justify-content-end align-items-center">
                <router-link :to=" { name: 'posts.show', params: { post: post.slug } }" title="Mostra dettagli del post">Dettagli > </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from "dayjs";

export default {
    props: {
        post: Object,
    },
    methods: {
        getPostCover(post) {
            return (
                //Ritorno il placeholder lato serve in Api/PostController index(),
                // quindi mi basta ritornare semplicemente coverImg
                //post.coverImg ?? 'https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126.png'
                post.coverImg
            );
        },
        formatDate(date) {
		    return dayjs(date).format('DD/MM/YYYY (HH:mm)');
	    },
    },
}
</script>

<style lang="scss" scoped>
    .card {
        max-height: 550px;

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .card-body{

            .card-text {
                height: 30px;
                width : 100%;
                overflow: hidden;
                display: inline-block;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }
    }
</style>