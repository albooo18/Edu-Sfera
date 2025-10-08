<template>
  <div class="container">
    <NavMenu />
    <router-view v-slot="{ Component }">
      <transition name="fade">
        <component :is="Component" />
      </transition>
    </router-view>
  </div>
  
</template>

<script>
import Ballina from '@/views/Ballina.vue';
import NavMenu from "@/components/NavMenu.vue";
import About from "@/views/Kontakti.vue";

export default {
  name: "App",
  components: { Ballina, NavMenu, About },

};
</script>

<style lang="scss">
@import "styles/variables";

body {
  // height: 150vh;
  overflow-x: hidden;
  background-color: white;
}

* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
  font-family: "Poppins";
}

.container{
  background-color: white;
  padding: 0;
}



.fade-enter-active {
  transition: all 0.5s ease-out;
}

.fade-enter-from,
.fade-leave-to {
  transform: translateY(3rem);
  opacity: .8;
}



@media (min-width: 1400px) {
  .container {
    max-width: 90vw;
  }
}
</style>
