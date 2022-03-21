<template>
    <div class="col">
        <div class="card my-3" style="height:400px">
            <img :src="getPostCover(post)" class="card-img-top" style="height:280px" alt="post images">
            
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text" v-html="post.content"></p>
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