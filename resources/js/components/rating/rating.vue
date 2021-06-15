<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="card">
                    <div class="card-content">
                        <div class="media-content">
                            <h1 class="title is-4">Star Rating</h1>
                            <h5 class="subtitle is-6">Alfa Bizz Rating Project</h5>
                        </div>
                        <div class="star-rating">
                            <span>&star;</span>
                            <span>&star;</span>
                            <span>&star;</span>
                            <span>&star;</span>
                            <span>&star;</span>

                            <div class="star-rating__current">
                                <span>&starf;</span>
                                <span>&starf;</span>
                                <span>&starf;</span>
                                <span>&starf;</span>
                                <span>&starf;</span>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-warning">Play with value {{ $value }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script id="Star-rating">
    <div class="star-rating">
        <span v-for="n in max">&star;</span>

        <div class="star-rating__current">
            <span v-for="n in max">&starf;</span>
            
        </div>
    </div>
</script>

<script>

import NotFound from '../NotFound.vue'
    export default {
  components: { NotFound },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
