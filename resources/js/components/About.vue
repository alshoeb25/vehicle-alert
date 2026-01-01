<template>
  <div class="page-wrapper">
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />

    <section class="page-header">
      <div class="page-header__bg" style="background: #fecc00;"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="page-header__wrapper">
              <div class="page-header__content">
                <h2>About Us</h2>
                <div class="page-header__menu">
                  <ul>
                    <li><a href="/">Home</a></li>
                    <li>About</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="about" class="about-area pt-120 pb-120">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="about-img-wrap">
              <div class="respo-app__img1-inner">
                <img src="/assets/images/img-2.jpeg" alt="" />
              </div>
              <div class="experience-year">
                <div class="icon">
                  <i class="flaticon-trophy"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content">
              <div class="section-title mb-35 tg-heading-subheading animation-style3">
                <span class="sub-title">Simply Know About</span>
                <h2 class="title tg-element-title" style="perspective: 400px;">Welcome to RespoQRCodes –</h2>
                <p class="mt-3">a brand presenting Inferlogic Consultancy Services Pvt Ltd., a cutting-edge IT solutions provider driven by innovation and expertise. With a commitment to delivering exceptional results, we bring together a team of skilled professionals and forward-thinking entrepreneurs to redefine possibilities in the digital landscape.</p>
              </div>
              <a href="#" class="thm-btn main-header__btn">
                <span>Read More</span>
                <div class="liquid"></div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="about-left-shape">
        <img src="/assets/images/about_shape02.png" alt="" />
      </div>
    </section>

    <section class="mission-area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-0 order-lg-2">
            <div class="choose-img-wrap">
              <img src="/assets/images/mission.jpeg" alt="" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="choose-content">
              <div class="white-title tg-heading-subheading animation-style3">
                <h2 class="title tg-element-title" style="perspective: 400px;">Our Misson</h2>
              </div>
              <p>To empower businesses through transformative technology solutions, fostering growth, efficiency, and resilience in the digital era</p>
              <br /><br />
              <h2 class="title tg-element-title" style="perspective: 400px;">Let's Transform Together</h2>
              <p>Embark on a journey of digital evolution with Inferlogic Consultancy Services Pvt Ltd. Together, let's turn challenges into opportunities, and aspirations into achievements.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="choose-shape-wrap">
        <img src="/assets/images/choose_shape01.png" alt="" />
        <img src="/assets/images/choose_shape02.png" alt="" />
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="about"
      @toggle-mobile="toggleMobileNav" 
      @toggle-chatbot="toggleChatbot" 
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HeaderNav from './HeaderNav.vue';
import FooterNav from './FooterNav.vue';

const mobileNavOpen = ref(false);
const chatbotOpen = ref(false);
const isLoggedIn = ref(false);

const toggleMobileNav = () => {
  mobileNavOpen.value = !mobileNavOpen.value;
  document.body.classList.toggle('locked');
};

const toggleChatbot = () => {
  chatbotOpen.value = !chatbotOpen.value;
  document.body.classList.toggle('show-chatbot');
};

const logout = async (e) => {
  e.preventDefault();
  try {
    const res = await fetch('/logout', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      }
    });
    if (res.ok || res.redirected) {
      window.location.href = '/';
    }
  } catch (err) {
    console.error('Logout failed:', err);
  }
};

onMounted(() => {
  const authMeta = document.querySelector('meta[name="user-authenticated"]');
  isLoggedIn.value = authMeta?.content === 'true';
});
</script>

<style scoped>
.mobile-nav__wrapper.expanded {
  visibility: visible;
}
.chatbot.show {
  transform: translateY(0);
  opacity: 1;
}
</style>
