<template>
    <div>
        <comments-component-form
            @newCommentForm="addNewComment($event)"
            :responseTo="responseTo"
            @resetResponse="responseTo = null"
        ></comments-component-form>

        <comment-component class="mt-5"
            v-for="comment in comments"
            :key="comment.id"
            :comment="comment"
            :now="now"
            @responseTo="responseTo = $event"
            
        ></comment-component>
    </div>
</template>

<script>
import CommentsComponentForm from "./CommentsComponentForm.vue";
import CommentComponent from "./CommentComponent.vue";

export default {
    components: {
        CommentsComponentForm,
        CommentComponent,
    },

    data() {
        return {
            comments: [],
            now: new Date(),
            responseTo: null
        };
    },

    methods: {
        // dateFormat(date) {
        //     // return  formatRelative(new Date(date), new Date(), { locale: fr})
        //     return formatDistance(new Date(date), this.now, { locale: fr });
        // },

        addNewComment(data) {

            if (!this.responseTo) {
                return this.comments.unshift(data);
            }

            console.log(this.responseTo)
            return this.responseTo.comments.unshift(data)
        
        },
    },

    // computed: {
    //     myFunction() {
    //
    //     },
    // },

    mounted() {
        // on fait varier la date avec cette fonction
        setInterval(() => {
            this.now = new Date();
        }, 1000);

        axios
            .get(`/comments/${btoa(window.location.href)}`)

            .then((response) => {
                this.comments = response.data.comments;
                console.log(response.data.comments)
            })
            .catch((err) => console.log(err));
    },
};
</script>

<style></style>
