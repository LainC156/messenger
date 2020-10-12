<template>
    <div>
        <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
            <b-img rounded="circle" slot="aside" blank blank-color="#ccc" width="48" alt="placeholder"></b-img>
            <b-card> 
                <slot></slot>
            </b-card>
        </b-media>
    </div>
</template>
<script>
export default {
    props: {
        writtenByMe: Boolean
    },
    data() {
        return {
            content: 'abc'
        };
    },
    mounted() {
        console.log('wbm: ', this.writtenByMe);
    }
}
</script>