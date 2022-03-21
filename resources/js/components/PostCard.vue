<template>
    <div class="col">
        <div class="card my-3" style="max-height:450px">
            <img :src="getPostCover(post)" class="card-img-top" style="height:280px" alt="post images">
            
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text" v-html="post.content"></p>
            
                <!-- Autore e data -->
                <em>Autore: {{ post.user.name }}
                    <br>
                    Data: {{ post.created_at }}
                </em>

                <br>

                  <!-- Categoria -->
                <div v-if="post.category" class="my-2">
                    <span class="bg-success rounded-pill p-1 text-white">
                        {{ post.category.code }}
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
    },
}
</script>

<style>

</style>