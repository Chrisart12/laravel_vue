<template>
  <div class="mt-5">
    <form action="" @submit.prevent="submitComment">
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Url</label>
        <input type="text" class="form-control" :class="{ errors: errors.url}"  v-model="comment.url" id="" />
        <span v-if="errors.url" class="alert alert-danger">{{ errors.url[0] }} </span>
      </div>
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" class="form-control" :class="{ errors: errors.name}"  v-model="comment.name" id="" />
        <span v-if="errors.name" class="alert alert-danger" v-text="errors.name[0]"></span>
      </div>
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Body</label>
        <input type="text" class="form-control" :class="{ errors: errors.body}" v-model="comment.body" id="body" />
        <span v-if="errors.body" class="alert alert-danger" v-text="errors.body[0]"></span>
      </div>
      <div class="row form-group col-4 ml-auto mr-auto">
        <button type="submit" class="btn btn-primary form-group col-4 ml-auto mr-auto">Enregistrer</button>
      </div>
    
    </form>
    <div v-for="comment in comments" :key="comment.id">
        <div class="card">
          <div class="card-header">
            <!-- {{ comment.name }} {{ dateFormat(comment.created_at) }} -->
            {{ comment.name }} {{  comment.human_created_at}}
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ comment.name }}</h5>
            <p class="card-text">{{ comment.body }}</p>
            <a href="#" class="btn btn-primary">{{ comment.url }}</a>
          </div>
        </div>
    </div>
  </div>
</template>

<script>

import { format, formatDistance, formatRelative, subDays } from 'date-fns'
import { fr } from 'date-fns/locale'

export default {
    data() {
        return {
          comment: {
            url: "",
            name: "",
            body: ""
          },

          comments: [],

          errors: []
        }
    },

    methods: {
        submitComment() {
            axios.post('/comments', {
              url: window.location.href,
              name: this.comment.name,
              body: this.comment.body

            }).then((response) => {
  
              this.comments.unshift(response.data.comment)
              this.comment = {}
              this.errors = []

            })
            .catch((err) => {
              this.errors = err.response.data.errors
            })
        },

        dateFormat(date) {
          console.log(new Date(date) )
          return  formatRelative(new Date(date), new Date(), { locale: fr})
        }
    },

    mounted() {
      
      axios.get(`/comments/${btoa(window.location.href)}`)
      
      .then((response) => {
        console.log('response', response)
        this.comments = response.data.comments 
      })
      .catch((err) => console.log(err))
    }
};
</script>

<style>
</style>