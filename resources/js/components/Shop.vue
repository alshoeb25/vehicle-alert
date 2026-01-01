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
                <h2>Shop</h2>
                <div class="page-header__menu">
                  <ul>
                    <li><a href="/">Home</a></li>
                    <li>Shop</li>
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
          <div class="col-lg-5">
            <div class="about-content">
              <div class="section-title mb-35 tg-heading-subheading animation-style3">
                <h2 class="title tg-element-title" style="perspective: 400px;">Shop RespoQRCodes™ Products</h2>
                <p class="mt-3">We offer a range of products and services under the <span class="faq-subtitle">RespoQRCodes</span>™ that can help the community stay connected to their Belongings</p>
                <p>We are often concerned about our vehicle when we go for a drive and park it somewhere. We never know what’s happening to our vehicle when we park it somewhere and walk away.</p>
                <p>VA mobile app helps a user to stay connected to their vehicle always. With this app, people can notify owners/users when their vehicle requires an attention, without disclosing any personal details of either party.</p>
              </div>
              <a href="#" class="thm-btn main-header__btn">
                <span>BUY Now</span>
                <div class="liquid"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="about-img-wrap">
              <div class="respo-app__img1-inner">
                <img src="/assets/images/shop.png" alt="">
              </div>
              <div class="experience-year">
                <div class="icon">
                  <i class="flaticon-trophy"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="about-left-shape">
        <img src="/assets/images/about_shape02.png" alt="">
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="shop"
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
