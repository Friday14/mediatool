<template>
    <div class="mt-3" v-show="list.length">
        <h4>History</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="(v, k) in list">
                <b>{{ ++k }}.</b>
                {{ v.name }} <a :href="v.url" target="_blank">{{ v.url }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import eventBus from "../eventBus";

    export default {
        name: "VideoHistory",
        data() {
            return {
                list: []
            }
        },
        mounted() {
            eventBus.$on('video.add', video => {
                this.list.push(video)
            })
        }
    }
</script>

<style scoped>

</style>