<template>
    <b-list-group-item :variant="variant">
        <b-row class="p-2" align-h="center">
            <b-col cols="12" md="3" class="text-center">
                <b-img rounded="circle" blank width="60" height="60" blank-color="#777" class="m-1" alt="img"></b-img>
            </b-col>
            <b-col cols="6" align-self="center" class="d-none d-md-block">
                <p class="mb-1">{{ name }}</p>
                <p class="mb-1 text-muted small">{{ lastMessage }}</p>
            </b-col>
            <b-col cols="3"  class="d-none d-md-block">
                <p class="mb-1 text-muted small">{{ lastTime }}</p>
            </b-col>
        </b-row>
    </b-list-group-item>
</template>

<script>
    export default {
        
        data() {
            return {
                name: 'Juan Ríos',
                lastMessage: 'adiós',
                lastTime: '1:37 pm',
                variant: 'dark'
            };
        },
        mounted() {
            console.log('Component mounted 123.')
        }
    }
</script>
