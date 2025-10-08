<template>
  <div class="quizCard" @mouseover="isHovered = true" @mouseleave="isHovered = false">
    <img :src="image" />
    <Transition name="diagonal">
      <div v-if="isHovered" class="Info">
        <h4>{{ name }}</h4>
        <p>{{ desc }}</p>
      </div>
    </Transition>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: ['image', 'desc', 'name'],
  setup() {
    const isHovered = ref(false)

    return {
      isHovered
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../styles/variables';

.quizCard {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;

  &::before {
    content: ' ';
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    position: absolute;
    z-index: 1;
    background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));
  }

  img {
    width: 200px;
    cursor: pointer;
    z-index: 2;
    filter: drop-shadow(0px 0px 15px black);
  }

  .Info {
    background-color: white;
    z-index: 2;
    width: 80%;
    height: 80%;
    position: absolute;
    display: flex;
    flex-direction: column;
    padding: 20px;
    top: 10px;
    left: 10px;
    transform: translate(20px, 20px);
    border-radius: 5px;

    h4 {
      color: $main;
      font-stretch: extra-expanded;
      font-family: "Poppins";
      font-weight: 700;
      letter-spacing: 3px;
      text-shadow: 0px 0px 5px $main;
    }

    p {
      font-size: 13px;
      letter-spacing: 2px;
      font-weight: 500;
      font-family: "Poppins";
      color: rgb(180, 180, 180);
    }
  }

  .diagonal-enter-active,
  .diagonal-leave-active {
    transition: all 0.3s ease-in-out;
  }

  .diagonal-enter-from,
  .diagonal-leave-to {
    opacity: 0.5;
    transform: translate(-10px, -10px); 
  }
}
</style>
