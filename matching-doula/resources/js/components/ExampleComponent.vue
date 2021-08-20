<template>
    <div>
        <ul>
            <li v-for="(message, key) in messages" :key="key">
                <strong>{{ message.message_user.name }}</strong>
                {{ message.message }}
            </li>
        </ul>
        <b-container fluid>
            <b-row>
                <b-col sm="9">
                    <b-form-input v-model="text"></b-form-input>
                </b-col>
                <b-col sm="3">
                    <b-button v-on:click="postMessage" pill variant="secondary text-white" :disabled="!textExists">送信</b-button>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    props: {
        messageRoomId: {
            type: Number,
            default: false,
        },
    },

    data() {
        return {
            text: "",
            messages: []
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
