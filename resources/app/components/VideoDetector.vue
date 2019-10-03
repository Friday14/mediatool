<template>
    <div>
        <div class="alert alert-danger" role="alert" v-show="hasError">
            Error
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-11 mb-3">
                        <input name="video" type="text" v-model="videoInput" required class="form-control"
                               placeholder="http://youtube.com/watch?v=u7deClndzQw">
                    </div>
                    <div class="col-auto">
                        <button type="submit" @click.prevent="fetchVideo" class="btn btn-primary mb-2">Go</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" v-if="video">
            <div class="card-body">
                <h3 class="card-title">{{ video.name }}</h3>
                <div class="row">
                    <div class="col-md-6">
                        <template v-if="!isPlay">
                            <img :src="video.thumbnail" @click="isPlay = true" alt="Click to play"
                                 class="video img-thumbnail">
                        </template>
                        <template v-else>
                            <iframe class="video" :src="`//www.youtube.com/embed/${video.id}?autoplay=1`"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        </template>
                    </div>
                    <div class="col-md-6">
                        <h4 pclass="card-title">Information</h4>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(v, k) in printInfo">
                                <td class="font-weight-bold">{{ k.toUpperCase() }}</td>
                                <td v-html="v"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import eventBus from "../eventBus";

    export default {
        name: "VideoDetector",
        data() {
            return {
                isPlay: false,
                hasError: false,
                videoInput: '',
                video: null
            }
        },
        computed: {
            service() {
                if (this.videoInput.indexOf('youtu') !== -1) {
                    return 'youtube'
                }
            },
            printInfo() {
                return {
                    id: this.video.id,
                    name: this.video.name,
                    author: this.video.author.name,
                    thumbnail: `<img src="${this.video.thumbnail}" width="70px">`,
                }
            }
        },
        methods: {
            fetchVideo() {
                this.isPlay = false;
                this.hasError = false;
                axios.get(`${process.env.VUE_APP_API_ENDPOINT}/api/${this.service}`, {
                    params: {video: this.videoInput}
                }).then(resp => {
                    this.video = resp.data;
                    eventBus.$emit('video.add', this.video)
                }).catch(() => {
                    this.hasError = true;
                });
            }
        }
    }
</script>

<style lang="scss">
    .video {
        width: 100%;
        height: 420px;
        @media (max-width: 500px) {
            height: 300px;
        }
        @media (max-height: 400px) {
            height: 280px;
        }
    }
</style>