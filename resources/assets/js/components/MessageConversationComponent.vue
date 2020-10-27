<template>
    <div>
        <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
            <b-img :src="image" rounded="circle" slot="aside" width="48" alt="placeholder"></b-img>
            <b-card> 
                <slot></slot>
            </b-card>
        </b-media>
    </div>
</template>
<script>
export default {
    props: {
        writtenByMe: Boolean,
        image: String
    },
    data() {
        return {
            content: 'abc'
        };
    },
    mounted() {
        console.log('messageConversationComponent mounted: ');
    }
}
</script>