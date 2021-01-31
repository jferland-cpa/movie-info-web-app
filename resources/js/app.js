require('./bootstrap');

import Vue from "vue";
import MovieList from "./components/MovieList.vue";

const app = new Vue({
    el: '#app',
    components: {
        MovieList
    }
});
