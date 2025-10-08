<template>
  <div class="header" id="header">
    <swiper :direction="'vertical'" :autoplay="{ delay: 5000, disableOnInteraction: true }" :pagination="{
      clickable: true,
    }" :modules="modules" class="mySwiper" @slideChange="onSlideChange">
      <swiper-slide v-for="(slide, index) in slides" :key="index" :style="{ backgroundImage: slide.bgImage }">
        <div :class="{ 'swiperContent': true, 'animate': currentSlideIndex === index }">
          <h1>{{ slide.heading }}</h1>
          <p>{{ slide.text }}</p>
          <button>{{ slide.button }}</button>
        </div>
      </swiper-slide>
    </swiper>
    <div class="paginationLine"></div>
    <h5>0{{ activeSlide }}<span>/</span>03</h5>
  </div>
  <div class="section" id="sherbimet">
    <img src="../assets/images/logo.png" alt="">
    <div class="servicesCards">
      <div class="card">
        <h2>Sherbimet tona.</h2>
        <div class="progressLine" style="margin-bottom: -20px;"></div>
        <button>Shiko</button>
      </div>
      <div class="card">
        <i class="far fa-comments"><svg width="100" height="60" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,0 0,80 100,100" fill="rgba(128, 128, 128, 0.307)" />
          </svg></i>
        <h4>Forumet</h4>
        <div class="progressLine"></div>
        <p>Forumet jane te bera per studentat e ndryshem qe deshirojn te shperndajn problemet e tyre.</p>
      </div>
      <div class="card">
        <i class="far fa-user" style="font-size: 60px;"><svg width="100" height="60" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,0 0,80 100,100" fill="rgba(128, 128, 128, 0.307)" />
          </svg></i>
        <h4>Dhoma bisedimesh</h4>
        <div class="progressLine"></div>
        <p>Dhoma bisedimesh per studentat qe deshirojn te diskutojnë me njeri-tjetrin.</p>
      </div>
      <div class="card">
        <i class="far fa-clock"><svg width="100" height="60" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,0 0,80 100,100" fill="rgba(128, 128, 128, 0.307)" />
          </svg></i>
        <h4>Kuizet</h4>
        <div class="progressLine"></div>
        <p>Kuizet te ndryshme per testimin e studenteve ne baze te zgjedhjes te tyre.</p>
      </div>
    </div>
  </div>
  <div class="progress section">
    <h2>Shoqerohu me studentet e tjere.</h2>
    <p>Sistem mundeson te krijoje lidhje me te tjere ne rast qe deshiron te shikosh postet e tyre apo te komunikosh me
      ta.</p>
    <div class="progressButtons">
      <button>Krijo Llogari</button>
      <button>Na Kontakto</button>
    </div>
  </div>
  <div class="quiz section">
    <div class="info">
      <h2>Kuizet qe ofrojme</h2>
      <p>
        Këto  kuize përfshijnë tema të fakulteteve te ndryshme, duke mbuluar aspekte të ndryshme.
        </p>
    </div>
    <div class="quizes">
      <div class="buttons">
        <a class="anchor" @click="filterQuizes(null)">All</a>
        <a class="anchor" @click="filterQuizes('Economy')">Economy</a>
        <a class="anchor" @click="filterQuizes('Law')">Law</a>
        <a class="anchor" @click="filterQuizes('Computer')">Computer Science</a>
      </div>
      <div class="cards">
        <TransitionGroup name="filter">
          <div class="quizcard" v-for="(quiz, index) in filteredQuizCards" :key="index">
            <QuizCard :desc="quiz.description" :image="quiz.img" :name="quiz.name" />
          </div>
        </TransitionGroup>
      </div>
    </div>
  </div>
  <h1 style="margin: auto;margin-top: 100px;text-align: center;">Qfare thojne njerzit</h1>
  <div class="komentet">
    <div class="koment">
      <div class="quote"><i class="fas fa-quote-left"></i></div>
      <blockquote>
        "Forumet janë një mundësi e shkëlqyer për të diskutuar dhe shkëmbyer ide me studentët e tjerë. Më kanë ndihmuar
        të gjej përgjigje për pyetje të ndryshme dhe të mësoj nga përvojat e të tjerëve
      </blockquote>
      <hr>
      <div class="personi">
        <img src="../assets/images/female.png">
        <h5>Elisa</h5>
      </div>
    </div>
    <div class="koment">
      <div class="quote"><i class="fas fa-quote-left"></i></div>
      <blockquote>"Dhoma bisedimesh janë fantastike për komunikim të drejtpërdrejtë. Ato
        mundësojnë shkëmbimin e mendimeve dhe ideve për projektet, duke i bërë mësimet më interesante dhe interaktive."
      </blockquote>
      <hr>
      <div class="personi">
        <img src="../assets/images/male.png">
        <h5>Arbri</h5>
      </div>
    </div>
    <div class="koment">
      <div class="quote"><i class="fas fa-quote-left"></i></div>
      <blockquote>"Kuizet janë një mënyrë shumë e dobishme për të testuar njohuritë dhe për të përforcuar atë që kemi
        mësuar. Ata janë sfidues, por gjithashtu ndihmojnë të kuptojmë se ku duhet të përmirësohemi më shumë."
      </blockquote>
      <hr>
      <div class="personi">
        <img src="../assets/images/female.png">
        <h5>Lea</h5>

      </div>
    </div>
  </div>

  <Footer />
</template>

<script>
import { computed, ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import "swiper/css/navigation";
import { Pagination, Autoplay, Navigation } from 'swiper/modules';
import QuizCard from '@/components/QuizCard.vue';
import Footer from '@/components/Footer.vue';

export default {
  name: 'Ballina',
  components: {
    Swiper,
    SwiperSlide,
    QuizCard,
    Footer,
  },
  setup() {

    const slides = [
      {
        heading: 'Forums',
        text: "Forumet studentore janë platforma ku studentët ndajnë mendime, diskutojnë tema, postojnë pyetje, ndihmojnë të tjerët, dhe kërkojnë informacion.",
        button: 'Shiko Postet',
        bgImage: `url(${require('@/assets/images/slider1.jpg')})`,
      },
      {
        heading: 'Kuziet',
        text: "Kuizet janë mjete interaktive që ndihmojnë studentët të mësojnë dhe përforcojnë njohuritë. Përmes pyetjeve dhe përgjigjeve, ata praktikojnë materialin e studiuar, identifikojnë dobësitë dhe përgatiten më mirë për provime apo detyra akademike.",
        button: 'Ploteso Kuize',
        bgImage: `url(${require('@/assets/images/slider2.jpg')})`,
      },
      {
        heading: 'Dhoma bisedimesh',
        text: "Dhoma bisedimesh janë hapësira virtuale ku studentët mund të komunikojnë. Ato mundësojnë shkëmbimin e ideve, diskutimet për temat e studimit dhe bashkëpunimin në projekte, duke forcuar lidhjet dhe ndihmuar në mësimin kolektiv.",
        button: 'Komuniko me te tjere',
        bgImage: `url(${require('@/assets/images/slider3.jpg')})`,
      },
    ];

    const quizCards = [
      {
        name: 'Banks and Finance',
        img: require("@/assets/images/banks.png"), description: 'The Banks and Finance faculty focuses on equipping students with comprehensive knowledge in banking, investment strategies, financial markets, and economic principles.', tags: ['Economy']
      },
      {
        name: 'Marketing',
        img: require("@/assets/images/marketing.png"), description: 'The Marketing faculty provides students with in-depth knowledge of consumer behavior, brand management, digital marketing, and market research.', tags: ['Economy']
      },
      {
        name: 'Computer Science',
        img: require("@/assets/images/computer.png"), description: 'The Computer Science faculty offers a robust curriculum in programming, algorithms, data structures, artificial intelligence, and software development..', tags: ['Computer']
      },
      {
        name: 'Education',
        img: require("@/assets/images/education.png"), description: 'The Education faculty focuses on teaching methodologies, curriculum development, educational psychology, and leadership, preparing students for careers in teaching, administration, and educational research.', tags: ['Education']
      },
      {
        name: 'Law',
        img: require("@/assets/images/law.png"), description: 'The Law faculty provides a comprehensive understanding of legal principles, constitutional law, criminal justice, and international law, preparing students for careers in legal practice, advocacy, and public policy.', tags: ['Law']
      },
      {
        name: 'Economy',
        img: require("@/assets/images/economy.png"), description: 'The Economics faculty explores macroeconomics, microeconomics, economic theory, and financial systems, equipping students with analytical skills for careers in finance, policy-making, and economic research.', tags: ['Economy']
      },
      // {
      //   name: 'JavaScript',
      //   img: require("@/assets/images/JS.png"), description: 'JavaScript is a versatile, high-level programming language enabling dynamic, interactive web experiences, widely used for both client-side and server-side development.', tags: ['Web']
      // },
      // {
      //   name: 'Html & CSS',
      //   img: require("@/assets/images/htmlcss.png"), description: 'HTML is the standard markup language for creating web pages.CSS is a stylesheet language used to describe the presentation and layout of HTML elements.', tags: ['Web']
      // },
    ]


    const activeSlide = ref(1);
    const currentSlideIndex = ref(0);
    const filteredQuizCards = ref(quizCards);

    const onSlideChange = (swiper) => {
      const currentIndex = swiper.activeIndex;
      activeSlide.value = currentIndex + 1;


      setTimeout(() => {
        currentSlideIndex.value = currentIndex;
      }, 50);
    };

    const filterQuizes = (lang) => {
      let getAnchors = document.querySelectorAll('.anchor');
      getAnchors.forEach(anchor => {
        anchor.addEventListener('click', () => {
          anchor.classList.add('active')
        })
        anchor.classList.remove('active')
      })
      filteredQuizCards.value = quizCards
      if (lang == null) return filteredQuizCards.value = quizCards
      return filteredQuizCards.value = filteredQuizCards.value.filter(quiz => quiz.tags.includes(lang))
    }


    return {
      slides,
      modules: [Pagination, Autoplay, Navigation],
      activeSlide,
      onSlideChange,
      currentSlideIndex,
      filterQuizes,
      filteredQuizCards
    };
  },
};
</script>

<style lang="scss">
@import "../styles/variables";
@import "../styles/buttons";

// header

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: "Poppins";

  h5 {
    align-items: center;
    display: flex;
    font-stretch: narrower;
    text-align: center;
    gap: 5px;
    font-size: 15px;
    color: $lightgray;
    margin: 0;

    span {
      font-size: 10px;
      font-weight: bold;
    }
  }

  .paginationLine {
    width: 20px;
    height: 2px;
    background-color: rgba(128, 128, 128, 0.123);
  }

  .swiper {
    width: 95%;
    height: 80vh;
    margin: 0%;
    box-shadow: 0px 0px 5px $lightgray;

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      // background-position: 100% 100%;
      background-size: cover;
      // background-repeat: no-repeat;
      // backdrop-filter: brightness(50%) blur(2px);
      overflow: hidden;
      position: relative;

      &::before {
        position: absolute;
        content: ' ';
        width: 100%;
        height: 100%;
        z-index: -2;
        background: linear-gradient(to right top, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3));
      }

      // &::after{
      //   position: absolute;
      //   content: " ";
      //   width: 100%;
      //   height: 100%;
      //   z-index: 1;
      //   filter: blur(10px);
      // }

      &:first-child {
        color: white;
      }

      .swiperContent {
        width: 60%;
        transition-delay: .5s;
        transition: .7s ease-in-out;


        h1 {
          transform: translateX(-100px);
          opacity: 0;
          font-size: 3rem;
          transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
          transition-delay: .8s;
        }

        p {
          transform: translateX(100px);
          font-size: 14px;
          opacity: 0;
          transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
          transition-delay: 1s;
          margin: 30px 0px;
        }

        button {
          transform: translateY(50px);
          opacity: 0;
          transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
          transition-delay: 1.2s;
        }

        &.animate {
          transition: .3s ease;
          transition-delay: .5s;

          h1 {
            opacity: 1;
            transform: translateX(0);
          }

          p {
            opacity: 1;
            transform: translateX(0);
          }

          button {
            opacity: 1;
            transform: translateY(0);
          }
        }


      }

      img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }

    .swiper-pagination {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .swiper-pagination-bullet {
      width: 30px;
      height: 3px;
      border-radius: 0;
      background-color: rgb(211, 211, 211);
      opacity: var(--swiper-pagination-bullet-inactive-opacity, 1);
      box-shadow: 0px 0px 5px $lightgray;

      &.swiper-pagination-bullet-active::before {
        width: 100%;
      }

      &::before {
        display: block;
        width: 0%;
        content: " ";
        height: 100%;
        background-color: $darkerMain;
        transition: .2s ease;
      }

      &:hover::before {
        width: 100%;
        transition: .2s ease;
      }
    }
  }
}

// Card Section

.section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
  align-items: center;

  img {
    max-width: 600px;
    max-height: 500px;
    transition: all .2s ease;

    &:hover {
      scale: 1.1;
      transition: all .2s ease;
    }
  }

  .servicesCards {
    display: flex;
    flex-wrap: wrap;
    padding: 50px 30px;
    gap: 30px;
    max-width: 800px;

    .card {
      display: flex;
      text-align: center;
      width: 300px;
      height: auto;
      box-shadow: 0px 0px 5px $lightergray;
      border-radius: 0;
      padding: 40px;
      transition: rotate .3s ease, box-shadow .1s ease;

      h4 {
        letter-spacing: 0px;
        transition: letter-spacing .3s ease;
        text-transform: uppercase;
        margin: 10px 0px;
        font-family: "Roboto";
        font-weight: 300;
      }

      &:hover {
        transition: rotate .3s ease, box-shadow .1s ease, text-shadow .2s ease;
        box-shadow: 0px 0px 10px $lightergray;

        h4 {
          text-shadow: 0px 0px 5px $lightergray;
          transition: text-shadow .2s ease, letter-spacing .3s ease;
          letter-spacing: 2px;
        }

        svg {
          rotate: 40deg;
          transition: rotate .3s ease;
        }
      }


      p {
        font-weight: 600;
      }

      &:hover .progressLine {
        width: 100px;
        transition: .2s ease;
      }

      &:hover .progressLine::before {
        width: 100%;
        transition: width .3s ease;
      }

      .progressLine {
        position: relative;
        height: 2px;
        background-color: $lightgray;
        width: 50px;
        margin: auto;
        transition: width .2s ease;

        & {
          margin: 10px auto;
        }

        &:hover::before {
          width: 100%;
          transition: all .3s ease;
        }

        &::before {
          content: ' ';
          position: absolute;
          width: 00%;
          height: 2px;
          background-color: dodgerblue;
          left: 50%;
          transform: translateX(-50%);
          top: 0px;
          transition: all .2s ease;
        }
      }



      i {
        position: relative;
        font-size: 50px;
        z-index: 2;
        background: transparent;
        margin: 10px 0px;

        svg {
          position: absolute;
          left: 65px;
          top: -10px;
          z-index: -1;
          rotate: 20deg;
          transition: rotate .3s ease;
        }
      }

      button {
        padding: 10px 30px 17px;

        &::before {
          margin-top: 7px;
        }
      }
    }
  }

}


// progress Section

.progress.section {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: center;
  gap: 20px;
  padding-right: 15vw;
  height: auto;
  width: 100%;
  min-height: 300px;
  height: auto;
  background-image: url('../assets/images/progress.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  color: white;

  &::before {
    content: ' ';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
    z-index: 1;
  }

  h2,
  p,
  .progressButtons {
    z-index: 2;
  }

  h2,
  p {
    letter-spacing: 2px;
  }

  p {
    width: 70%;
    text-align: right;
    font-size: 15px;
    font-weight: 500;
  }

  .progressButtons {
    display: flex;
    gap: 10px;

    button {
      padding: 15px 30px 15px;

      &::before {
        top: 2px;
      }
    }

    button:last-child {
      background: transparent;
      border: 2px solid white;
      color: white;

      &::before {
        background-color: $main;
      }

      &::after {
        position: absolute;
        content: ' ';
        z-index: -1;
        filter: blur(5px);
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
      }

      &:hover {
        border-color: dodgerblue;
      }
    }
  }
}

// Quiz Section

.quiz.section {
  padding: 50px;
  display: flex;
  flex-direction: column;
  gap: 30px;

  .info {
    width: 400px;
    text-align: center;
  }

  .quizes {
    display: flex;
    flex-direction: column;
    gap: 30px;
    align-items: center;

    .buttons {
      display: flex;
      min-height: 50px;
      align-items: center;
      justify-content: center;
      letter-spacing: 3px;

      a {
        cursor: pointer;
        font-size: 20px;
        padding: 0px 30px;
        transition: all .2s ease;
        text-decoration: none;
        color: $lightblack;
        font-weight: 300;

        &.active {
          color: $main;
        }

        &:hover {
          color: $main;
          transition: all .2s ease;

        }

        &:not(:last-child) {
          border-right: 1px solid $lightgray;
        }
      }
    }

    .cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      width: 100%;
      gap: 20px;
      height: auto;
      min-height: 600px;



      .filter-move,
      .filter-enter-active,
      .filter-leave-active {
        transition: all .5s ease;
      }

      .filter-enter-from,
      .filter-leave-to {
        transform: translate(100px, 100px);
        opacity: 0;
      }

      .filter-leave-active {
        position: absolute;
      }

      .quizcard {
        width: 350px;
        height: 300px;
        background-image: url('../assets/images/code.png');
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow: 0px 0px 15px $lightgray;

      }
    }
  }
}

// Komentet
.komentet {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  width: 100%;
  margin: 80px 0px;
  justify-content: space-evenly;


  .koment {
    width: 400px;
    height: auto;
    min-height: 300px;
    background-color: white;
    box-shadow: 10px 10px 10px $lightgray;
    border: 1px solid $lightgray;
    padding: 20px;
    position: relative;

    .personi {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      gap: 20px;


      img {
        background-color: gray;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-left: 20px;
      }

      h5 {
        letter-spacing: 2px;
        font-weight: 500px;
        font-family: "Roboto";
      }
    }


    blockquote {
      letter-spacing: 1px;
      font-style: italic;
      margin-top: 50px;
      min-height: 200px;
    }

    .quote {
      position: absolute;
      width: 70px;
      background-color: $main;
      border-radius: 50%;
      height: 70px;
      display: flex;
      justify-content: center;
      align-items: center;
      top: 0;
      left: 20px;
      transform: translateY(-50%);
      filter: drop-shadow(0px 0px 5px dodgerblue);
      border: 2px solid dodgerblue;

      i {
        font-size: 30px;
        color: white;
      }
    }
  }
}

// Footeri</style>
