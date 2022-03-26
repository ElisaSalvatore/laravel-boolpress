<template>
  <footer class="bg-light py-5">
    <div class="container">
      
      <!-- <h4 v-if="user">{{ user.name }} buona giornata!</h4> -->
    </div>
  </footer>
</template>


<script>
export default {
    name: "TheFooter",
    data() {
        return {
            user: null,
        };
    },
	methods: {
        getStoredUser() {
            const storedUser = localStorage.getItem("user");
            if (storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
                this.user = null;
            }
            // console.log(this.user);
        },
    },
    mounted() {
        this.getStoredUser();

        window.addEventListener("storedUserChanged", () => {
            this.getStoredUser(); // questa funzione la invochiamo ogni volta che stored user cambi
        });
    },
}
</script>

<style></style>