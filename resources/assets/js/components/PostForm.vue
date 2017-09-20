<template>
    <form action="" class="form-vertical" @submit.prevent="post">
        <div class="form-group">
            <textarea v-model="body" cols="30" rows="3" class="form-control" placeholder="Write something likeable"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Post it!</button>
    </form>
</template>

<script>
    import eventHub from '../event.js'

    export default {
        data() {
            return {
                body: null
            }
        },
        methods: {
            post() {
                axios.post('posts', {
                    body: this.body
                }).then(response => {
                    eventHub.$emit('post-added', response.data)
                    this.body = null
                })
            }
        }
    }
</script>
