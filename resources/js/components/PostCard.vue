<template>
    <div class="col">
        <div class="card my-3">
            <img :src="getPostCover(post)" class="card-img-top contain" alt="post images">
            
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text" v-html="post.content"></p>
            
                <!-- Autore e data -->
                <div>
                    Autore: <em class="mr-2">{{ post.user.name }} </em>
                    Data: <em>{{ formatDate(post.created_at) }}</em>
                </div>

                <br>

                  <!-- Categoria -->
                <div v-if="post.category" class="d-inline mr-2">
                    <span class="bg-success rounded p-1 text-white">
                        {{ post.category.code }}
                    </span>
                </div>

                <!-- Tags -->
                <div v-if="post.tags" class="d-inline">
                    <span
                        v-for="tag in post.tags"
                        :key="tag.id"
                        class="badge bg-warning p-1 mr-2"
                        > 
                        {{ tag.name }}
                    </span>
                </div>

            </div>

            <!-- LINK DETTAGLI -->
            <div class="card-footer d-flex justify-content-end align-items-center">
                <a href="#" title="Mostra dettagli del post">Dettagli</a>
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
                post.coverImg ?? 'https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126.png'
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

        > img {
            height:280px;
        }

        .card-body{

            .card-text {
                height: 30px;
            }

        }

    }
</style>