<template>
        <b-list-group>
            <contact-component 
                v-for="conversation in conversationsFiltered"
                :key="conversation.id"
                :conversation="conversation"
                :selected="isSelected(conversation)"
                @click.native="selectConversation(conversation)">
            </contact-component>
        </b-list-group>
</template>

<script>
    export default {
        methods: {
            selectConversation(conversation){
                //console.log('saludos:', conversation);
                /// emitir evento para que el componente padre pueda escuchar este evento
                //this.selectedConversationId = conversation.id;
                //this.$store.dispatch('getMessages', conversation);
                this.$router.push(`/chat/${conversation.id}`, () => {
                    this.$store.dispatch('getMessages', conversation);
                });
                //eventBus.$emit('example', conversation);
            },
            isSelected(conversation) {
                if(this.$store.state.selectedConversation) {
                    return this.$store.state.selectedConversation.id === conversation.id;
                }
                return false;
            }
        },
        computed: {
            selectedConversation() {
                return this.$store.state.selectedConversation;
            },
            conversationsFiltered() {
                return this.$store.getters.conversationsFiltered;
            }
        }
    }
</script>