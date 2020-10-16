<template>
    <div>
        <b-form class="mx-2 my-1" >
            <b-form-input class="text-center" type="text" placeholder="Buscar contacto"></b-form-input>
        </b-form>
        <b-list-group>
            <contact-component 
                v-for="conversation in conversations"
                :key="conversation.id"
                :conversation="conversation"
                @click.native="selectConversation(conversation)">
            </contact-component>
            <!-- 
            <contact-component variant="dark">
            </contact-component>
            <contact-component variant="">
            </contact-component>
            <contact-component variant="secondary">
            </contact-component> -->
        </b-list-group>
    </div>
</template>

<script>
    export default {
        props: {
            conversations: Array
        },
        data() {
            return {
            };
        },
        mounted() {
            console.log('contactListComponent mounted');
        },
        methods: {
            selectConversation(conversation){
                //console.log('saludos:', conversation);
                /// emitir evento para que el componente padre pueda escuchar este evento
                this.$emit('conversationSelected', conversation);
            }
        }  
    }
</script>