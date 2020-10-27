<template>
    <b-container>
        <b-form class="m-3" action="" method="post" enctype="multipart/form-data"> 
            <input type="hidden" name="_token" :value="csrf">
            <b-form-group label="Correo electrónico: ">
                <b-form-input type="email" disabled
                    name="email"
                    v-model="user.email"
                    placeholder="Ingresa tu correo"
                >
                </b-form-input>
            </b-form-group>
            <b-form-group label="Nombre: ">
                <b-form-input type="text" required
                    name="name"
                    v-model="user.name"
                    placeholder="Ingresa tu nombre"
                >
                </b-form-input>
            </b-form-group>
            <b-form-group label="Contraseña(solo si desea modificarla): ">
                <b-form-input type="password"
                    name="password"
                    placeholder="Ingresa nueva contraseña"
                >
                </b-form-input>
            </b-form-group>
            <b-form-group label="Imagen de perfil(solo si desea modificar): ">
                <b-img :src="image" rounded="circle" width="80%" alt="imagen de perfil" title="imagen actual"></b-img>
                <b-form-file name="image" placeholder="Selecciona una nueva imagen de perfil">
                </b-form-file>
            </b-form-group>
            <b-button type="submit" variant="primary">Guardar cambios</b-button>
        </b-form>
    </b-container>
</template>
<script>
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted() {
        console.log('token: ', this.csrf);
    },
    computed: {
        image() {
            return `/img/users/${this.user.image}`
        }
    }
}
</script>