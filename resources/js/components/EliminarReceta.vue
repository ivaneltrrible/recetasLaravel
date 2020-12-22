<template>
        <input
                type="submit"
                class="btn btn-danger w-100 d-block mb-2"
                value="Eliminar x"
                @click="eliminarReceta()"
        />
</template>

<script>
export default {
        props: ['recetaId'],
        methods: {
                eliminarReceta(){
                        this.$swal({
                                title: '¿Desea eliminar esta receta?',
                                text: 'No se puede revertir este proceso',
                                icon: 'info',
                                showCancelButton: true,
                                cancelButtonText: 'No, cancelar!',
                                confirmButtonText: 'Si, eliminar',
                                customClass: {
                                confirmButton: 'btn btn-outline-info mr-2',
                                cancelButton: 'btn btn-outline-danger'
                                },
                                buttonsStyling: false
                        })
                        .then((res) => {
                                if(res.value){
                                        const params = {
                                                id: this.recetaId
                                        }
                                        //Axios peticion
                                        axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                                        .then(respuesta => {
                                                this.$swal({
                                                        icon: 'success',
                                                        title: 'Eliminado',
                                                        text: 'Se elimino la receta correctamente'
                                                });
                                                //eliminar receta del DOM
                                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                                        })
                                        .catch(error => {
                                                console.log(error);
                                        })
                                        
                                }
                        })
                }
        },
};
</script>
