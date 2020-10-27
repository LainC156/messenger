<template>
    <b-form class="mx-2 my-1" >
        <b-form-input class="text-center" type="text" v-model="querySearch" placeholder="Buscar contacto"></b-form-input>
    </b-form>
</template>
<script>
export default {
    computed: {
        querySearch: {
            get() {
                return this.$store.state.querySearch;
            }, 
            set(value) {
                this.$store.commit('newQuerySearch', value);
            }
        }
    }    
}
</script>