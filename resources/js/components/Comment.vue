<template>
  <div>
    <form action="" @submit.prevent="submitComment">
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Url</label>
        <input type="text" class="form-control" v-model="url" id="" />
      </div>
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" class="form-control" v-model="name" id="" />
      </div>
      <div class="row form-group col-4 ml-auto mr-auto">
        <label for="exampleInputPassword1">Body</label>
        <input type="text" class="form-control" v-model="body" id="" />
      </div>
      <button type="submit" class="btn btn-primary form-group col-4 ml-auto mr-auto">Enregistrer</button>
    </form>
  </div>
</template>

<script>
export default {
    data() {
        return {
            url: "",
            name: "",
            body: ""
        }
    },

    methods: {
        submitComment() {
            
            console.log("eeeee")
        }
    }
};
</script>

<style>
</style>