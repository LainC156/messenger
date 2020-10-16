<template>
    <b-row>
        <!-- conversation -->
        <b-col cols="8">
            <b-card no-body 
                footer-bg-variant="light"
                footer-border-variant="dark"
                title="Conversación activa"
                class="h-100"
            >

                <b-card-body class="card-body-scroll">
                    <message-conversation-component
                    v-for="message in messages"
                    :key="message.id"
                    :writtenByMe="message.written_by_me"
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
            <b-img rounded="circle" blank width="60" height="60" blank-color="#777" class="m-1" alt="img"></b-img>
            <p>{{ contact_name }}</p>
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
    props: {
        contact_id: Number,
        messages: Array,
        contact_name: String
    },
    data() {
        return {
            newMessage: '',
        };
    },
    mounted() {
        console.log('activeconversationcomponent mounted');
        console.log('contact_id:', this.contact_id);
        
    },
    methods: {
        postMessage() {
            let params = {
                to_id: this.contact_id,
                content: this.newMessage
            };
            console.log('mensaje: ', this.newMessage);
            axios.post('/api/messages', params)
            .then((response) => {
                if(response.data.success) {
                    this.newMessage = '';
                    const message = response.data.message;
                    message.writte_by_me = true;
                    //this.messages.push(message);
                    this.$emit('messageCreated', response.data.message);
                    console.log('emitiendo evento desde postMessage()');
                }
            });
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
    }
}
</script>