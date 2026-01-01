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
                <h2>How does it work</h2>
                <div class="page-header__menu">
                  <ul>
                    <li><a href="/">Home</a></li>
                    <li>How does it work</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="work-area over-hidden">
      <div class="work-bg bg-no-repeat bg-cover pt-100" data-background="/assets/images/nag.png" style="background-image: url('/assets/images/work-bg.png');">
        <div class="container">
          <div class="work-wrapper pt-105 pb-85">
            <div class="row">
              <div class="col-md-6" v-for="(step, idx) in steps" :key="step.title">
                <div class="categoryWrapper">
                  <button>
                    <span><span><span data-attr-span="1">{{ step.number }}</span></span></span>
                  </button>
                  <div class="d-lg-flex" style="padding-left: 74px;">
                    <div class="work-icon d-inline-block text-center mr-30">
                      <span class="d-inline-block">
                        <i :class="step.icon" class="custom-css"></i>
                      </span>
                    </div>
                    <div class="work-text">
                      <h5 class="f-700 mb-22">{{ step.title }}</h5>
                      <p class="m-0">{{ step.text }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <a href="/shop" class="thm-btn main-header__btn" style="width: 260px; margin: auto;">
                <span><i class="fa-solid fa-back"></i> SHOP VA QR CODE</span>
                <div class="liquid" style="width: 260px;"></div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="how-it-works"
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

const steps = [
  { number: '01', icon: 'fa-solid fa-download', title: 'Download VA App', text: 'Download the VA App according to your mobile (iOS /Android)' },
  { number: '02', icon: 'fa-solid fa-user-plus', title: 'New account', text: 'Create your account with a username and password.' },
  { number: '03', icon: 'fa-solid fa-lock', title: 'Number Privacy', text: 'Messaging is 100% Private and anonymous.' },
  { number: '04', icon: 'fa-solid fa-cart-shopping', title: 'Buy VA Sticker', text: 'Buy once VA sticker for the Lifetime.' },
  { number: '05', icon: 'fa-solid fa-comment-sms', title: 'Get VA via SMS', text: 'Start Receiving VA SMS on your parked Vehicles.' },
  { number: '06', icon: 'fa-solid fa-phone-volume', title: 'Emergency Call', text: 'Add emergency contact details to receive a call.' },
  { number: '07', icon: 'fa-solid fa-qrcode', title: 'Scan VA QR Code', text: 'Scan the VA QR Code to send a message to the vehicle owner.' },
  { number: '08', icon: 'fa-solid fa-percent', title: 'Discount Offers', text: 'Get notifications on Special offer and discount' }
];

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
