<template>
    <b-container fluid style="height: calc(100vh - 66px)">
        <b-row no-gutters>
            <!-- conversations list -->
            <b-col cols="4">
                <contact-form-component/>
                <contact-list-component />
            </b-col>

            <!-- active conversation -->
            <b-col cols="8">
                <active-conversation-component
                    v-if="this.selectedConversation"
                >
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
export default {
    props: {
        user: Object
    },
    mounted() {
        console.log('messenger component mounted: ');
        this.$store.commit('setUser', this.user);
        this.$store.dispatch('getConversations')
            .then(() => {
                const conversationId = this.$route.params.conversationId;
                if( conversationId  ) {
                    const conversation = this.$store.getters.getConversationById(conversationId);
                    this.$store.dispatch('getMessages', conversation);
                    //console.log('conversation: ', conversation)
                }
            });
        
        

        this.laravel_private_channel_echo();
        this.laravel_presence_channel_echo();
    },
    methods: {
        changeActiveConversation(conversation){
            this.getMessages();
        },
        laravel_private_channel_echo() {
            Echo.private(`users.${this.user.id}`)
            .listen('MessageSent', (data) => {
                console.log('echo response message: ', data.message);
                const message= data.message;
                message.written_by_me = false;
                if(this.$store.state.selectedConversation.contact_id == message.from_id) {
                    /* solo la conversación seleccionada es igual a el destinatario del mensaje */
                    this.addMessage(message);
                }
            });
        },
        laravel_presence_channel_echo() {
            Echo.join('messenger')
            .here((users) => {
                this.$store.state.conversations.forEach( (conversation, index) => {
                    users.forEach( user => {
                       if(user.id == conversation.contact_id) {
                           this.$store.state.conversations[index].online = true;
                            console.log(`user.id: ${user.id}, conversation.contact_name: ${conversation.contact_name} y conversation.online: ${ conversation.online }`);
                       } else {
                            this.$store.state.conversations[index].online = false;
                            console.log(`user.id: ${user.id} y conversation ${ conversation.online }`);
                       }
                    });
                });
            })
            .joining(
                user => this.changeStatus(user, true)
            )
            .leaving(
                user => this.changeStatus(user, false)
            );
        },
        getMessages() {
            console.log('llamando a getMessage()');
            axios.get(`/api/messages?contact_id=${this.$store.state.selectedConversation.contact_id}`).then(
                (response) => {
                    console.log('mensajes: ', response.data)
                    this.$store.commit('newMessagesList', response.data);
                }
            );
        },
        changeStatus(user, status) {
            const index = this.$store.state.conversations.findIndex((conversation) => {
                return conversation.contact_id == user.id;
            });
            if(index >= 0) {
            this.$set(this.$store.state.conversations[index], 'online', status);
            }
            //console.log('this.conversations[index]: ', this.conversations[index]);
        },
        addMessage(message) {
            this.$store.commit('addMessage', message);
        }
    },
    computed: {
        selectedConversation() {
            return this.$store.state.selectedConversation;
        },
    }
}
</script>