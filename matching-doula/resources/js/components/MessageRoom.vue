<template>
    <div class="container">
        <div class="bg-light my-2">
            <div v-for="(message, key) in messages" :key="key">
                <div v-if="authusername == message.message_user.name">
                    <div class="d-flex flex-row-reverse align-items-start mb-4">
                        <div class="rounded-circle bg-secondary text-white fs-3 mr-1">
                        <b-avatar variant="bg-secondary">YOU</b-avatar>
                        </div>
                        <p class="p-2 ms-2 mb-0 bg-white border border-secondary rounded">
                        {{ message.message }}
                        </p>
                    </div>
                </div>
                <div v-else>
                        <div class="d-flex flex-row align-items-start mb-4">
                        <div class="rounded-circle bg-info text-white fs-3 ml-1">
                        <b-avatar variant="bg-info"></b-avatar>
                        </div>
                        <p class="p-2 ms-2 mb-0 bg-white border border-info rounded">
                        {{ message.message }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
            <b-row class="">
                <b-col sm="9" class="mt-2" >
                    <b-form-input v-model="text"></b-form-input>
                </b-col>
                <b-col sm="3" class="mt-2" >
                    <b-button v-on:click="postMessage" pill variant="secondary text-white" :disabled="!textExists">送信</b-button>
                </b-col>
            </b-row>
    </div>
</template>

<script>
export default {
    props: {
        messageRoomId: {
            type: Number,
            default: false,
        },
        authUser: {
            type: String,
        },
    },

    data() {
        return {
            text: "",
            messages: [],
            authusername: this.authUser,
        };
    },
    computed: {
        textExists() {
            return this.text.length > 0;
        }
    },
    created() {
        this.fetchMessages();
        Echo.private("chat." + this.messageRoomId ).listen("MessageSent", e => {
            this.messages.push({
                message: e.message.message,
                message_user: e.user
            });
        });
    },
    methods: {
        fetchMessages() {
            axios.get("messages" + "/" + this.messageRoomId).then(response => {
                this.messages = response.data;
            });
        },
        postMessage(message) {
            axios.post("messages" + "/" + this.messageRoomId, { message: this.text }).then(response => {
                this.text = "";
            });
        }
    }
};
</script>
