<template>
    <b-row class="h-100">
        <!-- conversation -->
        <b-col cols="8">
            <b-card
                footer-bg-variant="light"
                footer-border-variant="dark"
                title="Conversación activa"
                class="h-100"
            >
                <message-conversation-component
                v-for="message in messages"
                :key="message.id"
                :written-by-me="message.written_by_me"
                >
                {{ message.content }}
                </message-conversation-component>

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
            <p>Usuario seleccionado</p>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            contact_id: 3
        };
    },
    mounted() {
        console.log('component mounted');
        this.getMessages();
    },
    methods: {
        getMessages() {
            axios.get(`/api/messages?contact_id=${this.contact_id}`).then(
                (response) => {
                    console.log('response: ', response.data)
                    this.messages = response.data;
                }
            );
        },
        postMessage() {
            let params = {
                to_id: 2,
                content: this.newMessage
            };
            console.log('mensaje: ', this.newMessage);
            axios.post('/api/messages', params)
            .then((response) => {
                if(response.data.success) {
                    this.newMessage = '';
                    this.getMessages();
                } else {

                }
            });
        }
    }
}
</script>