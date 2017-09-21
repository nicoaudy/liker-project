<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Timeline</div>

                    <div class="panel-body">
                        <post-form></post-form>
                        <hr>
                        <post v-for="post in posts" :post="post" :key="post.id"></post>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from './Post'
    import PostForm from './PostForm'
    import eventHub from '../event.js'

    export default {
        data() {
            return {
                posts: []
            }
        },
        methods: {
            addPost(post) {
                this.posts.unshift(post)
            },
            likePost(postId) {
                var i;
                for (var i = 0; i <= this.posts.length; i++) {
                    if (this.posts[i].id === postId) {
                        this.posts[i].likeCount++
                        this.posts[i].likeByCurrentUser = true
                        break;
                    }
                }
            }
        },
        mounted() {
            eventHub.$on('post-added', this.addPost)
            eventHub.$on('post-liked', this.likePost)

            axios.get('/posts').then(response => {
                // listen to event in postwascreated in laravel side, and the name of
                // the channel must same in PostWasCreated Class
                Echo.private('posts').listen('PostWasCreated', (e) => {
                    // console.log(e)
                    eventHub.$emit('post-added', e.post)
                })

                this.posts = response.data
            })
        }
    }
</script>
