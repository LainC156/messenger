<template>
    <b-row>
        <!-- conversation -->
        <b-col cols="8">
            <b-card no-body 
                footer-bg-variant="light"
                footer-border-variant="dark"
                class="h-100"
            >

                <b-card-body class="card-body-scroll">
                    <message-conversation-component
                    v-for="message in messages"
                    :key="message.id"
                    :writtenByMe="message.written_by_me"
                    :image="message.written_by_me ? myImage : selectedConversation.contact_image"
                    >
                    {{ message.content }}
                    </message-conversation-component>
                </b-card-body>

                <div slot="footer">
                    <b-form class="mb-0" @submit.prevent="postMessage"
                        autocomplete="off">
                        <b-input-group>
                            <b-form-input
                                v-model="newMessage"
                                class="text-center"
                                type="text" 
                                placeholder="Escribe un mensaje">
                            </b-form-input>
                            <b-input-group-append>
                                <b-button type="submit" variant="primary">Enviar</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form>
            </div>
            </b-card>
        </b-col>
        <!-- contact info -->
        <b-col cols="4">
            <b-img rounded="circle" height="60" :src="selectedConversation.contact_image" class="m-1" alt="img"></b-img>
            <p>{{ selectedConversation.contact_name }}</p>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>
<style>
    .card-body-scroll {
        max-height: calc(100vh - 63px);
        overflow-y: auto;
    }
</style>
<script>
export default {
    data() {
        return {
            newMessage: '',
        };
    },
    mounted() {
        console.log('activeconversationcomponent mounted');
    },
    methods: {
        postMessage() {
            this.$store.dispatch('postMessage', this.newMessage)
            .then(() => {
                this.newMessage = '';
            })
            ;
        },
        scrollToBottom() {
            const el = document.querySelector('.card-body-scroll');
            el.scrollTop = el.scrollHeight;
            console.log('se ha usdo scrollToBottom');
        }
    },
    watch: {
        messages() {
            console.log('cambió la variable mensajes: ', this.messages);
            setTimeout(() => {
                console.log('llamando a scrollToBottom');
                this.scrollToBottom();
            }, 100);
        }
    },
    computed: {
        myImage() {
            return `/img/users/${this.$store.state.user.image}`;
        },
        messages() {
            return this.$store.state.messages;
        },
        selectedConversation() {
            return this.$store.state.selectedConversation;
        }
    }
        
}
</script>