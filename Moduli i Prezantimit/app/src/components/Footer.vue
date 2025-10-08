<template>
  <div class="footer">
    <div class="footerNav">
      <a href="#logo" @click="router.push({ name : 'Ballina' })">Ballina</a>
      <router-link to="/kontakti">Na Kontaktoni</router-link>
    </div>
    <div class="footerKontakt">
      <div class="contact">
        <i class="far fa-envelope"></i>
        albimehmeti777@gmail.com
      </div>
      <div class="contact">
        <i class="fas fa-phone"></i>
        +383 46-123-202
      </div>
    </div>
    <div class="copyright">Te drejtat autoriale &copy; te rezervuara</div>
  </div>
</template>

<script>
import { useRouter } from 'vue-router';

export default{
  setup(){
    const router = useRouter()

    return{
      router
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../styles/variables';

.footer {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 200px;
  background-color: #333;
  position: relative;
  gap: 50px;




  .footerNav {
    display: flex;
    flex-direction: column;
    border-right: 2px solid $lightgray;
    padding: 0px 30px;

    a {
      text-decoration: none;
      color: $lightgray;
      transition: all .2s ease;


      &:hover {
        transform: translateY(-5px);
        color: white;
        transition: all .2s ease;
      }
    }
  }

  .contact {
    color: white;
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 10px 0px;
  }



  .copyright {
    position: absolute;
    bottom: 0;
    left: 0;
    background-color: $main;
    width: 100%;
    padding: 10px;
    text-align: center;
    font-family: "Roboto";
  }
}
</style>