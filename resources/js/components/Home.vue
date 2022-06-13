<template>
    <div>
        <div class="col-12">
            <vueper-slides>
                <vueper-slide
                    v-for="slider in sliders"
                    :key="slider.id"
                    :title="slider.texto"
                    :content="slider.image">
                </vueper-slide>
            </vueper-slides>
            <!-- <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide d-flex align-items-center justify-content-center position-relative" :key="slider.id" v-for="slider in sliders">
                        <img :src="slider.image" :alt="slider.texto">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            
                
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div> -->
        </div>
    </div>
</template>

<script>
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

export default {
    components: { VueperSlides, VueperSlide },
    data(){
        return{
            sliders: []
        }
    },
    methods:{
        async getData(){
            await this.axios.get('/api/index')
                .then(res=>{
                    this.sliders = res.data.sliders;
                })
                .catch(err=>{
                    console.log(err);
                })
        }
    },
    created(){
        this.getData();
    }
}
</script>