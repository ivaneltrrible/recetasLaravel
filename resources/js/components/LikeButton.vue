<template>
    <div class="text-center">
        <span class="like-btn" @click="likeReceta()" :class="{ 'like-active' : isActive }"></span>
        <p>A {{ cantidadLikes }} personas les gusta esta receta</p>
    </div>
</template>

<script>
    export default {
        props: ['recetaId', 'like', 'likes'],
        data: function() {
            return {
                isActive: this.like,
                totalLikes: this.likes
            }
        },
        methods: {
            likeReceta(){
                axios.post('/recetas/'+ this.recetaId)
                .then(respuesta => {
                    if(respuesta.data.attached.length > 0 ){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }

                    //Efecto al dar like mas interactivo
                    this.isActive = !this.isActive
                })
                .catch(error => {
                    if(error.response.status === 401){
                        window.location = '/register';
                    }
                });
            }
        },
        computed: {
            cantidadLikes(){
                return this.totalLikes;
            }
        }
        
    }
</script>