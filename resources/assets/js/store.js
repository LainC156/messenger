import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        messages: [],
        selectedConversation: null,
        conversations: [],
        querySearch: '',
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        newMessagesList(state, messages) {
            state.messages = messages;
        },
        addMessage(state, message) {
            const conversation = state.conversations.find((conversation) => {
                return conversation.contact_id == message.from_id || conversation.contact_id == message.to_id;
            });
            const author = state.user.id === message.from_id ? 'Tú' : conversation.contact_name;
            conversation.last_message = `${author}: ${message.content}`;
            conversation.last_time = message.created_at;
            console.log('conversación a la cual se le actualizaron los datos: ', conversation);

            if(this.$store.state.selectedConversation.contact_id == message.from_id || this.selectedConversation.contact_id == message.to_id) {
                this.$store.commit('addMessage', message);
            }

        },
        addMessage(state, message) {
            state.messages.push(message);
        },
        selectConversation(state, conversation) {
            state.selectedConversation = conversation;
        },
        newQuerySearch(state, newValue) {
            state.querySearch = newValue;
        },
        newConversationList(state, conversations) {
            state.conversations = conversations;
        }
    },
    actions: {
        getMessages(context, conversation){
            axios.get(`/api/messages?contact_id=${conversation.contact_id}`).then(
                (response) => {
                    context.commit('newMessagesList', response.data);
                    context.commit('selectConversation', conversation);
                }
            );
        },
        getConversations(context) {
            return axios.get('/api/conversations')
            .then((response) => {
                console.log('response: ', response.data);
                //this.conversations = response.data;
                context.commit('newConversationList', response.data);
            });
        },
        postMessage(context, newMessage) {
            let params = {
                to_id: context.state.selectedConversation.contact_id,
                content: newMessage
            };
            //console.log('mensaje: ', this.newMessage);
            axios.post('/api/messages', params)
            .then((response) => {
                if(response.data.success) {
                    newMessage = '';
                    const message = response.data.message;
                    message.writte_by_me = true;
                    //this.messages.push(message);
                    context.commit('addMessage', message);
                    console.log('emitiendo evento desde postMessage()');
                }
            });
        }
    },
    getters: {
        conversationsFiltered(state) {
            return state.conversations.filter( conversation =>   conversation.contact_name.toLowerCase().includes(state.querySearch.toLowerCase() ) );
        },
        getConversationById(state) {
            return function(conversationId) {
                return state.conversations.find( conversation => conversation.id == conversationId)
            }
        }
    }
});