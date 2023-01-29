<template>
    <div class="container">
        <input type="text" v-model="name">
        <input type="checkbox" v-model="checkbox">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component2</div>

                    <div class="card-body">
                        I'm an example component.fffffff
                        {{ name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted uusjjsjsjsjs')
        },

        data() {
            return {
                name: "Issa",
                checkbox: true

            }
        }
    }
</script>
