<template>

    <div class="col-sm-2">

        <button type="submit"
                class="btn btn-default" @click="toggle">
            <span :class="classes"></span>
            <span v-text="count"></span>
        </button>
    </div>


</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },
        computed: {
            classes() {
                return ['fa ', this.active ? ' fa-heart' : ' fa-heart-o'];
            },
            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },
        created() {

        },
        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },
            create() {
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
            },
            destroy() {
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
            }


        }

    }
</script>

