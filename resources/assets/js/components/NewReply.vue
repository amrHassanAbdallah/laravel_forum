<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 10px">
                <div v-if="signedIn">

                    <div class="form-group">
                            <textarea id="body" name="body" placeholder="Have something to say ?" required
                                      rows="5" style="width: 100%" v-model="body"></textarea>
                    </div>

                    <button @click="addReply" class="btn btn-default" type="submit">post</button>
                </div>
                <div v-else>

                    <p class="text-center"> Please <a href="/login">sign in</a> to participate in this
                        discussion.</p>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['endpoint'],
        data() {
            return {
                body: '',
            }
        },
        methods: {
            addReply() {
                if (this.body) {
                    axios.post(this.endpoint, {body: this.body}).then(({data}) => {
                        this.body = '';
                        this.$emit('created', data);
                        flash("Your reply has been posted.");
                    });

                }
            }
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        }
    }
</script>

