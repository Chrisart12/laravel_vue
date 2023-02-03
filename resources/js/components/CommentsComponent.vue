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

        <div class="text-center mt-4 curseur-pointer" @click="getMore(next_page_url)" v-if="next_page_url">Suivant...</div>
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
            responseTo: null,
            next_page_url: "",

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

        // axios
        //     .get(`/comments/${btoa(window.location.href)}`)

        //     .then((response) => {
        //         // console.log('rrrrrrrrrr', response.data.comments)
        //         console.log( response.data.comments)
        //         this.next_page_url = response.data.comments.next_page_url;
        //         // this.comments = response.data.comments;
        //         this.comments = response.data.comments.data;
        //     })
        //     .catch((err) => console.log(err));

        this.getMore(`/comments/${btoa(window.location.href)}`)
    },


    methods: {
        getMore(next_page_url) {

            axios
            .get(next_page_url)

            .then((response) => {
            
                this.next_page_url = response.data.comments.next_page_url;
                // this.comments = response.data.comments.data;
                this.comments = this.comments.concat(response.data.comments.data);
            })
            .catch((err) => console.log(err));
        }
    }
};

</script>

<style></style>
