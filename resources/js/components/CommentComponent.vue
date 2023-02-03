<template>
    <div class="card col-8 ml-auto mr-auto">
        <div class="card-header">
            <!-- {{ comment.name }} - Il y a {{ dateFormat(comment.created_at) }} -->
            <!-- {{ comment.name }} {{  comment.human_created_at}} -->
            {{ comment.name }} - Il y a {{ dateFormat }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ comment.name }}</h5>
            <div v-if="edit" class="card-text">
                <form action="" @submit.prevent="editCommentBody" id="editFormComment">
                    <!-- <input type="text" v-model=""> -->
                    <textarea class="form-control" name="" id="" cols="30" 
                    rows="10" v-model="commentEditForm.body">
                    </textarea>
                </form>
            </div>

            <div v-if="!edit">
                {{ comment.body }}
            </div>
            <a href="#" class="btn btn-primary">{{ comment.url }}</a>
        </div>
        
        <div v-if="!edit" class="display_flex_x_s_b">
            <div class="mb-5">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 0 24 24"
                    width="24px"
                    fill="#000000"
                >
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"
                    />
                </svg>
            
                <button
                    type="button"
                    class="btn btn-info"
                    @click="$emit('responseTo', comment)"
                >
                    Répondre
                </button>
            </div>
            
            <div class="mb-5 ml-3">
                <svg class="svg_width" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                    <path d="M9 39h2.2l22.15-22.15-2.2-2.2L9 36.8Zm30.7-24.3-6.4-6.4 2.1-2.1q.85-.85 2.1-.85t2.1.85l2.2 2.2q.85.85.85 2.1t-.85 2.1Zm-2.1 2.1L12.4 42H6v-6.4l25.2-25.2Zm-5.35-1.05-1.1-1.1 2.2 2.2Z"/>
                </svg>
                <button
                    type="button"
                    class="btn btn-info"
                    @click.stop.prevent="editBody"
                >
                    Modifier
                </button>
            </div>   

        </div>

        <div v-else class="display_flex_x_s_b">
            <div class="mb-5">
                <svg class="svg_width" xmlns="http://www.w3.org/2000/svg" height="48" 
                    width="48"><path d="m17.9 32.2 6.1-6.1 6.1 6.1 2.1-2.1-6.1-6.1 6.1-6.1-2.1-2.1-6.1 6.1-6.1-6.1-2.1 2.1 6.1 6.1-6.1 6.1ZM7 40q-1.2 0-2.1-.9Q4 38.2 4 37V11q0-1.2.9-2.1Q5.8 8 7 
                    8h34q1.2 0 2.1.9.9.9.9 2.1v26q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h34V11H7v26Zm0 0V11v26Z"/>
                </svg>
            
                <button
                    type="button"
                    class="btn btn-info"
                    @click="edit = false"
                >
                    Annuler
                </button>
            </div>
            
            <div class="mb-5 ml-3">
                <svg class="svg_width" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                    <path d="M42 13.85V39q0 1.2-.9 2.1-.9.9-2.1.9H9q-1.2 0-2.1-.9Q6 40.2 6 
                    39V9q0-1.2.9-2.1Q7.8 6 9 6h25.15Zm-3 1.35L32.8 9H9v30h30ZM24 35.75q2.15 0 3.675-1.525T29.2 30.55q0-2.15-1.525-3.675T24 25.35q-2.15 0-3.675 1.525T18.8 30.55q0 2.15 1.525 3.675T24 35.75ZM11.65 18.8h17.9v-7.15h-17.9ZM9 15.2V39 9Z"/>
                </svg>
                <button
                    type="submit"
                    class="btn btn-info"
                    form="editFormComment"
            
                >
                    Enregistrer
                </button>
            </div>   

        </div>

        <!-- <comment-component class="ml-5" v-if="comment.comments.length"> -->
            <comment-component
                class="card ml-3 mt-3 card-background"
                v-for="commentchild in comment.comments"
                :key="commentchild.id"
                :comment="commentchild"
                :now="now"
                @responseTo="$emit('responseTo', $event)"
            >
                <div class="card-header">
                    {{ commentchild.name }} - Il y a {{ dateFormat }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ commentchild.name }}</h5>
                    <p class="card-text">{{ commentchild.body }}</p>
                    <a href="#" class="btn btn-info">{{ commentchild.url }}</a>
                </div>

            </comment-component>
        <!-- </comment-component> -->
    </div>
</template>

<script>
import { format, formatDistance, formatRelative, subDays } from "date-fns";
import { fr } from "date-fns/locale";
// import CommentComponent from "./CommentComponent.vue";

export default {

    name: "comment-component",

    props: ["comment", "now"],

    data() {
        return {
            edit: false,
            commentEditForm: {
                // id: "",
                body: this.comment.body
            }
        };
    },

    methods: {
        editBody() {
            
           return this.edit = true
        },

        resetBody() {
            this.edit = false
            // this.commentEditForm.body = this.comment.body
        },

        editCommentBody() {
            console.log("modifierdddd")
            axios
                .put(`/comments/${this.comment.id}`, {
                        
                        body: this.commentEditForm.body,
                    
                    }
                )
                .then((response) => {
                    
                    // console.log(response)
                    console.log(response.data)
                    // this.comments.unshift(response.data.comment);
                    // this.$emit('newCommentForm', response.data.comment)
                    // this.comment.name = "";
                    // this.comment.body = "";
                    // this.errors = [];

                    this.resetBody()
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        }

    },

    computed: {
        dateFormat() {
            // return  formatRelative(new Date(date), new Date(), { locale: fr})
            return formatDistance(new Date(this.comment.created_at), this.now, {
                locale: fr,
            });
        },
    },

    // computed: {
    //     dateFormat() {
    //
    //     },
    // },

    mounted() {
        // on fait varier la date avec cette fonction
        // setInterval(() => {
        //     this.now = new Date();
        // }, 1000);
    },
};
</script>

<style></style>
