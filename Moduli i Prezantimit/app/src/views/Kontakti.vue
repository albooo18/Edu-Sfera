<template>

    <div :class="{ 'container-fluid': true, 'darken': showForm }">
         <div class="container">
            <h1>Keni pyejte?</h1>
            <p>
                Jeni të interesuar për një bashkëpunim, keni pyetje, ose dëshironi të na lini një mesazh? Plotësoni
                formularin, dhe ne do t’ju përgjigjemi sa më shpejt të jetë e mundur.
                Ju lutemi sigurohuni që të plotësoni të gjitha fushat e kërkuara dhe të përfshini sa më shumë detaje që
                të jetë e mundur, në mënyrë që të mund t’ju ndihmojmë më mirë.
                Faleminderit që na kontaktuat!
            </p>
        </div>

        <div class="container">
            <div class="contactDiv" id="emailContact" @click="showForm = !showForm">
                <i class="fas fa-envelope"></i>
                Dergo Email
            </div>
            <div class="contactDiv" id="phoneContact">
                <i class="fas fa-phone"></i>
                Numri Kontaktues
                <h5>+383 46-123-202</h5>
            </div>
        </div> 

         <ContactForm :showModul="showForm" @closeModule="closeModul()" />
         <Footer /> 
    </div>
</template>

<script>
import { ref } from 'vue'
import ContactForm from '@/components/ContactForm.vue';
import Footer from '@/components/Footer.vue'

export default {
    name: "Kontakti",
    components: { ContactForm, Footer },
    setup() {
        const showForm = ref(false)

        const closeModul = () => {
            showForm.value = !showForm.value
        }

        return {
            showForm,
            closeModul
        }
    }
}

</script>

<style lang="scss" scoped>
@import '../styles/variables';

.container-fluid {
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-wrap: wrap;
    position: relative;
    margin: 0;
    padding: 0;

    footer {
        z-index: -1;
    }

    &.darken {
        &::before {
            content: ' ';
            width: 100vw;
            height: 105vh;
            background-color: #33333373;
            position: absolute;
            top: -14vh;
            left: -5vw;
        }
    }

    .container {
        width: 35%;

        &:first-child {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            gap: 50px;

            h1 {
                font-size: 80px;
                font-weight: bold;
                color: $main;
                -webkit-text-stroke: 2px black;
            }

            p {
                line-height: 2;
                font-size: 20px;
            }
        }

        &:last-child {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }

    .container{
        display: flex;
        gap: 30px;
        flex-wrap: wrap;

        .contactDiv {
            width: 280px;
            height: 280px;
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-shadow: 0px 0px 5px $lightergray;
            background-image: linear-gradient(to top left, rgba(0, 0, 0, 0.1), rgba(30, 143, 255, 0.068));
            transition: all .2s ease;

            &:first-child {
                cursor: pointer;
            }

            &:hover {
                box-shadow: 0px 0px 9px $lightgray;
                transition: all .2s ease;
                scale: 1.02;
                color: rgb(65, 65, 65);
            }

            i {
                font-size: 3rem;
            }
        }
    }


}
</style>