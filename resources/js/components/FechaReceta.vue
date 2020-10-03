<template>
    <span v-text="formatearFecha"></span>
</template>

<script>
export default {
    props:['fecha'],
    // mounted() {
    //     console.log('la hora de creacion de la receta es ' + this.fecha);
    // },
    computed: {
        formatearFecha(){
            return moment(this.fecha).locale('es-mx').format('DD [de] MMMM [del] YYYY')
        }
    },
};
</script>
