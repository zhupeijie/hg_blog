<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">话题列表</div>

                <div class="panel-body">
                    <div v-for="topic in topics" :key="topic.id" class="bs-callout bs-callout-danger">
                        <h4>
                            <router-link :to="{ name: 'topics', params: {id: topic.id} }">{{ topic.title }}
                            </router-link>
                        </h4>
                        <p>{{ topic.excerpt }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/topics').then(response => {
                this.topics = response.data.data;
            });
        },
        data() {
            return {
                topics: []
            }
        }
    }
</script>
