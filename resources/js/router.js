import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Contacts from "./pages/Contacts.vue";
import PostShow from "./pages/posts/Show.vue";
import Error from "./pages/Error.vue";

Vue.use(VueRouter);

const router = new VueRouter({
	mode: "history",
    routes: [
		{ path: "//", 
			component: Home, 
			name: "home.index",
			meta: { title: "Homepage", linkText: "Home"}
		}, 
		{ path: "/contacts", 
			component: Contacts, 
			name: "contacts.index",
			meta: { title: "Contatti", linkText: "Scrivici!"}
		},
		{ path: "/posts/:post", 
			component: PostShow, 
			name: "posts.show",
			meta: { title: "Dettagli post"},
		},
		{ path: "*", //rotta errore generico
			component: Error,
			name: "error"
		},
	],
});

router.beforeEach((to, from, next) => {
	document.title = to.meta.title;
	next();
})

export default router; 