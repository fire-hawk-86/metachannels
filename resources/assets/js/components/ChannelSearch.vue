<template>
    <div class="input-container">
        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" v-model:value="value" v-on:keyup="typing">
        <ul class="list-unstyled">
            <li v-for="channel in channels" v-bind:data-url="channel.url" v-on:click="copyChannel">{{ channel.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                value: '',
                channels: [],
                url: window.envAppUrl+'/searchyoutubechannel/',
                timeout: null
            }
        },
        methods: {
            typing: function () {
                clearTimeout(this.timeout);
                if (this.value == ''){
                    this.channels = [];
                };
                this.timeout = setTimeout(this.getJson, 500);
            },
            getJson: function () {
                var self = this;
                axios.get(self.url+self.value)
                    .then( function (response) {
                        self.channels.length = 0;
                        for (var i in response.data.items) {
                            self.channels.push(
                                {
                                    name: response.data.items[i].snippet.title,
                                    url: 'https://www.youtube.com/channel/'+response.data.items[i].snippet.channelId
                                }
                            );
                        }
                    });
            },
            copyChannel: function (event) {
                this.value = event.target.getAttribute("data-url");
                this.channels.length = 0;
            }
        }
    }
</script>

<style>
    .input-container {
        position: relative;
    }
        .input-container ul {
            position: absolute;
            width: 100%;
            top: 38px;
            background: rgb(51, 51, 51);
            z-index: 1;
        }
            .input-container li {
                border: 1px solid rgb(25, 25, 25);
                padding: .5rem;
                cursor: pointer;
            }
            .input-container li:hover {
                background: rgb(100, 100, 100);
            }
</style>