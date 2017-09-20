<template>
    <div class="media">
        <like-button></like-button>
        <div class="media-left">
            <a href="#">
                <img class="media-object" :src="post.user.avatar" :alt="post.user.name + ' avatar' ">
            </a>
        </div>
        <div class="media-body">
            <strong>{{ post.user.name }}</strong>
            <p>{{ post.body }}</p>
            <p>{{ post.likeCount }}  {{ pluralize('like', post.likeCount) }}</p>
        </div>
    </div>
</template>

<script>
    import pluralize from 'pluralize'
    import LikeButton from './LikeButton'

    export default {
        props: ['post'],
        components: [
            LikeButton
        ],
        methods: {
            pluralize
        }
    }
</script>

<style scoped>
    .media {
        position: relative;
        margin: 0;
        padding: 10px;
    }

    .media:hover .like {
        display: block;
    }
</style>
