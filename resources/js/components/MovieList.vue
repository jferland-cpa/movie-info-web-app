<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Movie List</div>
                    <div class="card-body">
                        <p v-for="(movie, index) in movies" :key="index">{{ movie.title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                movies: []
            }
        }, mounted() {
            axios.get("/api/movies").then(response => {
                this.movies = response.data;
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>
