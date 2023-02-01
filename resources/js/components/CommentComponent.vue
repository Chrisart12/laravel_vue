<template>
    <div class="card col-8 ml-auto mr-auto">
        <div class="card-header">
            <!-- {{ comment.name }} - Il y a {{ dateFormat(comment.created_at) }} -->
            <!-- {{ comment.name }} {{  comment.human_created_at}} -->
            {{ comment.name }} - Il y a {{ dateFormat }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ comment.name }}</h5>
            <p class="card-text">{{ comment.body }}</p>
            <a href="#" class="btn btn-primary">{{ comment.url }}</a>
        </div>
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

    // data() {
    //     return {
    //         // comment: {},
    //         now: new Date(),
    //     };
    // },

    // methods: {
    //     dateFormat(date) {
    //         // return  formatRelative(new Date(date), new Date(), { locale: fr})
    //         return formatDistance(new Date(date), this.now, { locale: fr });
    //     },

    // },

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
