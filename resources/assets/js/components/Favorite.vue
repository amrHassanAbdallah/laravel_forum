<template>

    <div class="col-sm-2">

        <button type="submit"
                class="btn btn-default" @click="toggle">
            <span :class="classes"></span>
            <span v-text="favoritesCount"></span>
        </button>
    </div>


</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },
        computed: {
            classes() {
                return ['fa ', this.isFavorited ? ' fa-heart' : ' fa-heart-o'];
            },
            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },
        created() {

        },
        methods: {
            toggle() {
                this.isFavorited ? this.destroy() : this.create();
            },
            create() {
                axios.post(this.endpoint);
                this.isFavorited = true;
                this.favoritesCount++;
            },
            destroy() {
                axios.delete(this.endpoint);
                this.isFavorited = false;
                this.favoritesCount--;
            }


        }

    }
</script>

