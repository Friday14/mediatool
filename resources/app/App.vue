<template>
    <div id="app" class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <VideoDetector></VideoDetector>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <VideoHistory></VideoHistory>
                </div>
            </div>
        </div>
        <!--    <HelloWorld msg="Welcome to Your Vue.js App"/>-->
    </div>
</template>

<script>
    import VideoDetector from "./components/VideoDetector";
    import VideoHistory from "./components/VideoHistory";

    export default {
        name: 'app',
        components: {
            VideoDetector,
            VideoHistory
        }
    }
</script>
