<template>
    <div class="mt-5 col-4 ml-auto mr-auto">
        <div>
            <span>Votre commentaire</span>
            <div v-if="responseTo">
                <span >à {{ responseTo.name }}, pour répondre à « {{ responseTo.body }} »
                   
                </span>
                <button type="button" class="btn btn-danger" @click="$emit('resetResponse')">Annuler</button>
            </div>
            
            
        </div>
        <form action="" @submit.prevent="submitComment">
            <!-- <div class="row form-group col-4 ml-auto mr-auto">
                <label for="exampleInputPassword1">Url</label>
                <input
                    type="text"
                    class="form-control"
                    :class="{ errors: errors.url }"
                    v-model="comment.url"
                    id=""
                />
                <span v-if="errors.url" class="alert alert-danger"
                    >{{ errors.url[0] }}
                </span>
            </div> -->
            <div class="row form-group">
                <label for="exampleInputPassword1">Name</label>
                <input
                    type="text"
                    class="form-control"
                    :class="{ errors: errors.name }"
                    v-model="comment.name"
                    id=""
                />
                <span
                    v-if="errors.name"
                    class="alert alert-danger"
                    v-text="errors.name[0]"
                ></span>
            </div>
            <div class="row">
                <label for="exampleInputPassword1">Body</label>
                <input
                    type="text"
                    class="form-control"
                    :class="{ errors: errors.body }"
                    v-model="comment.body"
                    id="body"
                />
                <span
                    v-if="errors.body"
                    class="alert alert-danger"
                    v-text="errors.body[0]"
                ></span>
            </div>
            <div class="row mt-3">
                <button
                    type="submit"
                    class="btn btn-primary form-group"
                >
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</template>

<script>


export default {
    props: [
        'responseTo', 
    ],

    data() {
        return {
            comment: {
                url: window.location.href,
                name: "",
                body: "",
            },

            // comments: [],

            errors: [],
        };
    },

    computed: {

        fullForm() {

            if (this.responseTo) {
                return {
                    ...this.comment,
                    comment_id: this.responseTo.id,
                }
            }

            return this.comment
        }

    },

    methods: {
        submitComment() {
            // console.log("eeeeeeeeee", this.comments)
            axios
                .post("/comments", 
                    // url: window.location.href,
                    // name: this.fullForm.name,
                    // body: this.fullForm.body,
                    this.fullForm
                )
                .then((response) => {
                    // this.comments.unshift(response.data.comment);
                    this.$emit('newCommentForm', response.data.comment)
                    this.comment = {};
                    this.errors = [];
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        }

    }
   
};
</script>

<style></style>
