<template>
  <div class="page-wrapper">
    <!-- Header -->
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />

    <!-- Main Slider -->
    <section class="main-slider-one main-slider-one--two">
      <div class="main-slider-two__carousel owl-carousel owl-theme">
        <div class="main-slider-one__single">
          <div class="main-slider-one--two-img">
            <img src="/assets/images/slider2.png" alt="" />
          </div>
          <div class="image-layer" style="background-color: #fecc00;"></div>
          <div class="container-fluid">
            <div class="main-slider-one__content">
              <div class="title">
                <h2>Someone Hit a <br> Parked Car?</h2>
              </div>
              <div class="text">
                <p>In publishing and graphic design, Lorem ipsum may be used as a placeholder before final copy is available.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="main-slider-one__single">
          <div class="main-slider-one--two-img">
            <img src="/assets/images/slider3.png" alt="" />
          </div>
          <div class="image-layer" style="background-color: #fecc00;"></div>
          <div class="container-fluid">
            <div class="main-slider-one__content">
              <div class="title">
                <h2>Worried about Nuisance <br> parking?</h2>
              </div>
              <div class="text">
                <p>In publishing and graphic design, Lorem ipsum may be used as a placeholder before final copy is available.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="main-slider-one__single">
          <div class="main-slider-one--two-img">
            <img src="/assets/images/slider4.png" alt="" />
          </div>
          <div class="image-layer" style="background-color: #fecc00;"></div>
          <div class="container-fluid">
            <div class="main-slider-one__content">
              <div class="title">
                <h2>Worried about Nuisance <br> parking?</h2>
              </div>
              <div class="text">
                <p>In publishing and graphic design, Lorem ipsum may be used as a placeholder before final copy is available.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Respo App Section -->
    <section class="respo-app">
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="respo-app__img clearfix">
              <div class="respo-app__img1 wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                <div class="respo-app__img1-inner">
                  <img src="/assets/images/mobile-app.png" alt="" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="respo-app__content">
              <div class="section-title">
                <span class="section-title__tagline">Vehicle Alerts</span>
                <p class="vehical-alert-title">Vehicle Alerts VA provides a fast and reliable way to Report any Incident or Get notified about your parked vehicle in Real Time via SMS or WhatsApp on your Cell Phone.</p>
              </div>
              <div class="respo-app__content-inner vehical-alert-section">
                <div class="text">
                  <h2>Messaging is 100% Private and anonymous</h2>
                </div>
                <div class="respo-app__content-list">
                  <ul>
                    <li><p>Wrong Parking / Vehicle Blocking</p></li>
                    <li><p>Left Car Lights On</p></li>
                    <li><p>Parked Within A Tow-Away Zone</p></li>
                    <li><p>Left Doors Open</p></li>
                    <li><p>Road Accident</p></li>
                    <li><p>Left Baby in the Car</p></li>
                    <li><p>Flat Tire</p></li>
                    <li><p>Windows Open</p></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call Back Area -->
    <section class="call-back-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 download-app">
            <a href="#"><img src="/assets/images/google-play.png" alt="" /></a>
            <a href="#"><img src="/assets/images/app_store.png" alt="" /></a>
          </div>
          <div class="col-lg-6 contact-main" style="margin-top: 13px;">
            <a href="/contact" class="contact-btn">
              <img src="/assets/images/contact.png" alt="" /> <span> Contact Us</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
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
                <p class="mt-3">a brand presenting Inferlogic Consultancy Services Pvt Ltd. a cutting-edge IT solutions provider driven by innovation and expertise.</p>
              </div>
              <a href="/about" class="thm-btn main-header__btn">
                <span>Read More</span>
                <div class="liquid"></div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="about-left-shape">
        <img src="/assets/images/about_shape02.png" alt="">
      </div>
    </section>

    <!-- Services Section -->
    <section class="services-area services-bg" style="background-image: url('/assets/images/services_bg.jpg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-8">
            <div class="section-title text-center mb-40">
              <h2 class="title tg-element-title">Vehicle Alerts – VA QR Code</h2>
              <p>Vehicle Alerts – VA QR Code provides a fast and reliable way to Report any Incident or Get notified about your parked vehicle in Real Time.</p>
            </div>
          </div>
        </div>
        <div class="services-item-wrap">
          <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
              <div class="services-item shine-animate-item">
                <div class="services-thumb">
                  <a class="shine-animate" href="#"><img src="/assets/images/img1.png" alt=""></a>
                </div>
                <div class="services-content">
                  <div class="icon"><img src="/assets/images/contact.png" alt=""></div>
                  <h4 class="title"><a href="#">Messaging is 100% Private</a></h4>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
              <div class="services-item shine-animate-item">
                <div class="services-thumb">
                  <a class="shine-animate" href="#"><img src="/assets/images/img2.png" alt=""></a>
                </div>
                <div class="services-content">
                  <div class="icon"><img src="/assets/images/call.png" alt=""></div>
                  <h4 class="title"><a href="#">Emergency Contact</a></h4>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
              <div class="services-item shine-animate-item">
                <div class="services-thumb">
                  <a class="shine-animate" href="#"><img src="/assets/images/data.png" alt=""></a>
                </div>
                <div class="services-content">
                  <div class="icon"><img src="/assets/images/data-icon.png" alt=""></div>
                  <h4 class="title"><a href="#">Data Protection</a></h4>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
              <div class="services-item shine-animate-item">
                <div class="services-thumb">
                  <a class="shine-animate" href="#"><img src="/assets/images/img4.png" alt=""></a>
                </div>
                <div class="services-content">
                  <div class="icon"><img src="/assets/images/cost.png" alt=""></div>
                  <h4 class="title"><a href="#">Cost Effective</a></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Choose Area -->
    <section class="choose-area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-0 order-lg-2">
            <div class="choose-img-wrap">
              <img src="/assets/images/expertise-img.jpeg" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="choose-content">
              <div class="section-title white-title mb-30">
                <span class="sub-title black-color">Our Expertise</span>
              </div>
              <p class="black-color">Backed by a diverse team of IT specialists, we excel in software development, cloud solutions, data analytics, artificial intelligence, and cybersecurity.</p>
              <a href="/about" class="mt-4 thm-btn main-header__btn">
                <span>Read More</span>
                <div class="liquid" style="background: #fff;"></div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Secure QR Section -->
    <section class="secureQr">
      <div class="container">
        <div class="col-xxl-12 col-xl-12 col-lg-12">
          <div class="text-center">
            <img src="/assets/images/secureQR.png" alt="">
            <div class="section-title-wrapper is-white mb-30">
              <h2 class="section-title">HOW WE PROVIDE YOU SECURE ALERTS</h2>
            </div>
            <p>Respo QR Codes™ is a service that allows you to create tags, each with a unique ID acting as a dedicated mobile number for the item it's attached to.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-choose">
      <div class="container">
        <div class="section-title__style2">
          <div class="section-title">
            <h2 class="section-title__title" style="font-size: 30px;color: #000;">Why Choose</h2>
          </div>
        </div>
        <div class="row">
          <div v-for="reason in whyChoose" :key="reason.title" class="col-xl-3 col-lg-4 col-md-6 col-sm-8 wow fadeInLeft">
            <div class="why-choose__single">
              <div class="why-choose__single-img">
                <div class="why-choose__single-img-inner"></div>
                <div class="icon-box">
                  <img class="parallax-img" :src="reason.icon" :style="reason.style">
                </div>
              </div>
              <div class="why-choose__single-content text-center">
                <h2><a href="#">{{ reason.title }}</a></h2>
                <p>{{ reason.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="home"
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

const whyChoose = ref([
  {
    title: 'Innovation',
    description: 'We embrace the latest technologies and methodologies to create solutions that stand out in the market.',
    icon: '/assets/images/icon1.png',
    style: 'padding-top: 22px; width: 26%;'
  },
  {
    title: 'Collaboration',
    description: 'Our team works seamlessly to understand your unique needs and collaboratively develop tailored solutions.',
    icon: '/assets/images/Collaboration.png',
    style: 'padding-top: 25px; width: 38%;'
  },
  {
    title: 'Reliability',
    description: 'With a track record of successful projects, we are a trusted partner in your journey to digital transformation.',
    icon: '/assets/images/Reliability.png',
    style: 'padding-top: 24px; width: 27%;'
  },
  {
    title: 'Results-Driven',
    description: 'Our focus is on delivering tangible, measurable results that contribute to your business success.',
    icon: '/assets/images/Driven.png',
    style: 'padding-top: 22px; width: 26%;'
  }
]);

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
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token")')?.getAttribute('content') || ''
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
  // Check if user is logged in (you can pass this from Laravel via a meta tag or prop)
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
