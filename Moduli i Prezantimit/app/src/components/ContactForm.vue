<template>
  <div class="container" :class="{
    'active' : showModul
  }">

    <form @submit.prevent="sendEmail">
    <i class="fas fa-x" @click="$emit('closeModule',false)"></i>
      <div>
        <input v-model="Email" name="email" type="email" placeholder=" " required />
        <label for="email"><i class="far fa-envelope"></i> Email-i</label>
      </div>
      <div>
        <input v-model="Emri" name="emri" type="text" placeholder=" " required />
        <label for="emri"><i class="far fa-user"></i> Emri</label>
      </div>
      <div>
        <input v-model="Mbiemri" name="mbiemri" type="text" placeholder=" " required />
        <label for="mbiemri"><i class="far fa-user"></i> Mbiemri</label>
      </div>
      <div>
        <textarea v-model="Mesazhi" name="mesazhi" placeholder=" " required></textarea>
        <label for="mesazhi"><div class="far fa-message"></div> Mesazhi</label>
      </div>
      <button type="submit">Dergo</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue'
import emailjs from 'emailjs-com';

export default {
  props: ['showModul'],
  setup() {

    const Email = ref('');
    const Emri = ref('');
    const Mbiemri = ref('');
    const Mesazhi = ref('');

    const sendEmail = async () => {
      try {
        const response = await emailjs.send(
          'service_68qaew8',
          'template_urp5xpz',
          {
            to_email: Email.value,
            subject: Emri.value + ' ' + Mbiemri.value,
            message: Mesazhi.value
          },
          'p3Mt7euFjlWtf5Rql'
        );
        alert('Mesazhi u dergua me sukses');
        console.log(response);

        Email.value = '';
        Emri.value = '';
        Mbiemri.value = '';
        Mesazhi.value = ''
      } catch (error) {
        console.error('Gabimi ne dergim te mesazhit:', error);
        alert('Dergimi i mesazhit ka deshtuar ju lutem provoni me vone');
      }
    };


    return {
      Email,
      Emri,
      Mbiemri,
      Mesazhi,
      sendEmail,
    };
  }
}
</script>

<style lang="scss" scoped>
@import '../styles/variables';

.container {
  position: absolute;
  top: -1000px;
  transition: top .4s ease;

  &::before{
    content: ' ';
  }

  .container.active{
    top: -100px;
    transition: top .4s ease;

  }

  form {
    position: absolute;
    outline: none;
    display: flex;
    flex-direction: column;
    width: 500px;
    height: auto;
    min-height: 300px;
    justify-content: space-between;
    gap: 30px;
    padding: 50px;
    background-color: white;
    border: 1px solid $main;

    .fas{
      position: absolute;
      left: 20px;
      top: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: all .2s ease;
      color: $lightgray;

      &:hover{
        scale: 1.3;
        transition: all .2s ease;
      }
    }
    

    button{
      border-radius: 20px;
      width: 100%;

      &::before{
        border-radius: 17px;
      }
    }

    div {
      position: relative;

      input,
      textarea {
        padding: 20px;
        height: 50px;
        border-radius: 30px;
        position: relative;
        width: 100%;
        outline: none;
        border: none;
        background-color: $lightergray;
        font-size: 15px;
      }

      textarea{
        height: 150px;
        resize: none;
      }

      label {
        position: absolute;
        z-index: 1;
        top: 15px;
        left: 20px;
        transition: 0.2s ease all;
        color: #999;
        font-size: 15px !important;
      }

      input:focus~label,
      textarea:focus~label,
      input:not(:placeholder-shown)~label,
      textarea:not(:placeholder-shown)~label {
        transform: translateY(-35px);
        font-size: 0.8rem !important;
        color: #333;
      }
    }

  }
}
</style>