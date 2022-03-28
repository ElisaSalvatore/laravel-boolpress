<template>
    <div>
        <h1 v-if="user">Ciao {{user.name}}, benvenut* nel Vue Blog!</h1>
        <h1 v-else>Ciao, benvenut* nel Vue Blog!</h1>
        <h2>Post più recenti</h2>

        <!-- FILTRO -->
        <div class="my-4">
            <input type="text" 
                class="form-text" 
                placeholder="Cosa cerchi?"
                v-model="searchText"
                @keydown.enter="onSearchSubmit"
            > 
        </div>

        <!-- BOTTONE RICARIDA DATI -->
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" @click="fetchPosts">
                <i class="fa-solid fa-rotate-right"></i> Ricarica Dati
            </button>
        </div> 

        <div class="progress my-3" v-if="loading">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                Caricamento...
            </div>
        </div>

        <!-- CARD -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <PostCard v-for="post of posts" :key="post.id" :post="post">
                <!-- contenuto di ogni singola card presente nel componente -->
            </PostCard>
        </div>

        <!-- PAGINATION -->
        <nav aria-label="Page navigation example" class="d-flex justify-content-center my-5">
            <ul class="pagination">
                <li class="page-item" 
                    :class="{ disabled: pagination.current_page === 1 }"
                    >
                        <a @click="fetchPosts(pagination.current_page - 1)" class="page-link">Previous</a>
                </li>
                <li class="page-item" 
                    :class="{ active: pagination.current_page === page }"
                    v-for="page in pagination.last_page" 
                    :key="page"
                    >
                        <a @click="fetchPosts(page)" class="page-link">{{ page }}</a>
                </li>
                <li class="page-item"
                    :class="{ disabled: pagination.current_page === pagination.last_page }"
                    >
                    <a @click="fetchPosts(pagination.current_page + 1)" class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import axios from "axios";
import PostCard from "../components/PostCard.vue";

export default {
    components: {PostCard},

    data() {
        return {
            posts: [],
            pagination: {},
            loading: true,  // è true di deafult perchè all'apertura della pagina carico i dati 
            user: null,
            searchText: "",
        };
    },
    methods: {
        async fetchPosts(page = 1, searchText = null) {
            if(page < 1) {
				page = 1;
			}

			if(page > this.pagination.last_page) {
				page = this.pagination.last_page;
			}

            // axios.get("/api/posts?page=" + page).then((response) => {
            //     this.pagination = response.data;
        	//     this.posts = response.data.data;
            // });


            // Prima della chiamata axios setto a true
            this.loading = true;
            // So già il promise aspetterà che il browser esegua questa riga di codice *
            const response = await axios.get("/api/posts?page=", {
                params: {
                    page,
                    filter: searchText,
                }
            });
            this.pagination= response.data;
            this.posts = response.data.data;

            // * Dopo la chiamata axios metto un setTimeout perchè la chiamata è talmente veloce 
            // che non si vedrebbe nemmeno il caricamento
            setTimeout(() => {
                this.loading = false;
            }, 1000);
        },
        getStoredUser() {
            const storedUser = localStorage.getItem("user");
            if (storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
                this.user = null;
            }
            // console.log(this.user);
        },
        onSearchSubmit(page = 1) {
            this.fetchPosts(1, this.searchText)
        }
    },
    mounted() {
        this.fetchPosts();
        this.getStoredUser();
        
        window.addEventListener("storedUserChanged", () => {
            this.getStoredUser(); // questa funzione la invochiamo ogni volta che stored user cambi
        });
    },
}
</script>

<style lang="scss" scoped>
.pagination {
    .page-item {
        cursor: pointer;
    }
}
</style>