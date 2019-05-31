<template>
    <div :id="'reply-'+id" class="card" style="margin-top: 30px">

        <div class="card-header">
            <div class="level row">
                <div class="col-sm-10">
                    <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"> </a>
                    said <span v-text="ago"></span>

                </div>
                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>
        </div>

        <div class="card-body">
            <article v-if="editing">
                <textarea class="form-control-plaintext" v-model="body"></textarea>
                <button @click="update" class="btn btn-xs btn-primary">Update</button>
                <button @click="editing=false" class="btn btn-xs btn-link">Cancel</button>
            </article>

            <article v-else v-text="body">
            </article>
            <hr>

        </div>

        <div class="card-footer" v-if="canUpdate">
            <button @click="editing=true" class="btn btn-xs d-inline-block"> Edit</button>
            <button @click="destroy" class="btn btn-danger btn-xs d-inline-block"> Delete</button>

        </div>
    </div>

</template>

<script>
    import Favorite from './Favorite';
    import moment from 'moment';

    export default {
        props: ['data'],
        components: {Favorite},
        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body

            }
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            ago() {
                return moment(this.data.created_at).fromNow()
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },
        created() {

        },
        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });
                this.editing = false;
                flash('Updated !');
            },
            destroy() {
                axios.delete('/replies/' + this.data.id);
                this.$emit('deleted', this.data.id)
                /*                $(this.$el).fadeOut(300, () => {
                                    flash('Your reply has been deleted . ');

                                });*/
                /*
                                document.getElementById('reply-'+this.data.id).remove();
                */

            }


        }

    }
</script>

