<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> <h4>{{ topic.title }}</h4> </div>

                    <div class="panel-body">
                        <div class="bs-callout bs-callout-danger">
                            <p>{{ topic.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/topics/' + this.$route.params.id).then(response => {
                this.topic = response.data;
            });
        },
        data() {
            return {
                topic: {}
            }
        }
    }
</script>
