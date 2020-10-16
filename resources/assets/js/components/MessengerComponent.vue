<template>
    <b-container fluid style="height: calc(100vh - 66px)">
        <b-row no-gutters>
            <!-- conversations list -->
            <b-col cols="4" >
                <contact-list-component
                    @conversationSelected="changeActiveConversation($event)"    
                    :conversations="conversations"
                >
                </contact-list-component>
            </b-col>

            <!-- active conversation -->
            <b-col cols="8">
                <active-conversation-component
                    v-if="this.selectedConversation"
                    :contact_id="selectedConversation.contact_id"
                    :contact_name="selectedConversation.contact_name"
                    :messages="messages"
                    @messageCreated="addMessage($event)"
                >
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
export default {
    props: {
        user_id: Number
    },
    data() {
        return {
            selectedConversation: null,
            messages: [],
            conversations: []
        };
    },
    mounted() {
        console.log('messenger component mounted: ');
        this.getConversations();
        this.laravel_echo();
    },
    methods: {
        changeActiveConversation(conversation){
            this.selectedConversation = conversation;
            this.getMessages();
        },
        laravel_echo() {
            Echo.private(`users.${this.user_id}`)
            .listen('MessageSent', (data) => {
                console.log('echo response message: ', data.message);
                const message= data.message;
                message.written_by_me = false;
                if(this.selectedConversation.contact_id == message.from_id) {
                    /* solo la conversación seleccionada es igual a el destinatario del mensaje */
                    this.addMessage(message);
                }
            });
        },
        getMessages() {
            console.log('llamando a getMessage()');
            axios.get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`).then(
                (response) => {
                    console.log('mensajes: ', response.data)
                    this.messages = response.data;
                }
            );
        },
        addMessage(message) {
            const conversation = this.conversations.find((conversation) => {
                return conversation.contact_id == message.from_id || conversation.contact_id == message.to_id;
            });
            const author = this.user_id === message.from_id ? 'Tú' : conversation.contact_name;
            conversation.last_message = `${author}: ${message.content}`;
            conversation.last_time = message.created_at;
            console.log('conversación a la cual se le actualizaron los datos: ', conversation);

            if(this.selectedConversation.contact_id == message.from_id || this.selectedConversation.contact_id == message.to_id) {
                this.messages.push(message);
            }
        },
        getConversations() {
            axios.get('/api/conversations')
            .then((response) => {
                console.log('response: ', response.data);
                this.conversations = response.data;
            });
        },
    }
}
</script>