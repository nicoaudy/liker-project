<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <post v-for="post in posts" :post="post" :key="post.id"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from './Post'

    export default {
        data() {
            return {
                posts: []
            }
        },
        mounted() {
            axios.get('/posts').then(response => {
                this.posts = response.data
            })
        }
    }
</script>
