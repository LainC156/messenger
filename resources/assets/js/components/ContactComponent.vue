<template>
    <b-list-group-item :variant="variant">
        <b-row class="p-2" align-h="center">
            <b-col cols="12" md="3" class="text-center">
                <b-img rounded="circle" :src="conversation.contact_image" height="60" class="m-1" alt="img"></b-img>
            </b-col>
            <b-col cols="6" align-self="center" class="d-none d-md-block">
                <p class="mb-1">
                    <b-img rounded="circle" blank width="10" height="10" :blank-color="conversation.online ? 'green' : 'gray'" alt="img"></b-img>
                    {{ conversation.contact_name }}
                </p>
                <p class="mb-1 text-muted small">{{ conversation.last_message }}</p>
            </b-col>
            <b-col cols="3"  class="d-none d-md-block">
                <p class="mb-1 text-muted small">{{ lastTime }}</p>
            </b-col>
        </b-row>
    </b-list-group-item>
</template>

<script>
    export default {
        props: {
            conversation: Object,
            selected: Boolean
        },
        data() {
            return {
            };
        },
        mounted() {
            console.log('ContactComponent mounted')
            let conv = this.conversation.online ? 'green' : 'gray';
            console.log('conv: ', this.conversation.online);
            console.log(`estado de ${this.conversation.contact_name}: ${this.conversation.online}`);
        },
        computed: {
            lastTime(){
                return moment(this.conversation.last_time, "YYYY-MM-DD hh:mm:ss")
                             .locale('es').fromNow();
            },
            variant() {
                return this.selected ? 'secondary' : '';
            }
        }
    }
</script>
