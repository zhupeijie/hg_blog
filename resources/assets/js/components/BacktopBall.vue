<template>
    <div id="backtop-ball" @click="backTop">
        <!--<span v-else :style="{height: ~~result + '%'}"> {{ result }} </span>-->
    </div>
</template>

<script>
    export default {
        name: "backTop",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
