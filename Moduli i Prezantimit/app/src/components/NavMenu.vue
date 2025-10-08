<template>
    <nav>
        <div class="logo" id="logo">
            <img src="../assets/images/logo.png" :class="{ 'active': sizeLogo }" @mouseenter="sizeLogo = true"
                @mouseleave="sizeLogo = false">
            Edu-Sfera
        </div>
        <div class="navLinks">
            <router-link to="/ballina">Ballina</router-link>
            <router-link to="/kontakti">Na Kontaktoni</router-link>
            <a href="#">Kyquni</a>
        </div>
    </nav>
</template>

<script>
import {  ref } from 'vue';

export default {
    setup() {
        const sizeLogo = ref(false)

        return {
            sizeLogo
        }
    }
}
</script>


<style lang="scss">
@import '../styles/variables';

nav {
    padding: 10px 10px;
    display: flex;
    font-family: "Poppins";
    font-weight: 500;
    align-items: center;

    .logo {
        width: 100%;
        font-size: 30px;

        img {
            width: 100px;
            transition: all .3s ease;


            &.active {
                width: 110px;
                transition: all .3s ease;

            }
        }


    }

    .navLinks {
        display: flex;
        gap: 50px;
        width: 35%;


        a {
            text-decoration: none;
            color: $lightblack;
            font-weight: 500;
            position: relative;
            padding: 5px 0px;
            transition: .2s ease;


            &:hover {
                transform: translateY(-3px);
                transition: .2s ease;
            }

            &.router-link-active::before {
                bottom: 0;
                opacity: 1;
                transition: .2s ease;
            }

            &:hover::before {
                bottom: 0;
                opacity: 1;
            }

            &::before {
                content: ' ';
                position: absolute;
                width: 100%;
                margin: auto;
                bottom: -10px;
                opacity: 0;
                left: 0;
                height: 3px;
                background-color: $main;
                transition: .2s ease;
            }
        }
    }
}
</style>