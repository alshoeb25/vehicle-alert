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
          <div class="col-lg-6 contact-main">
            <a href="/contact" class="contact-btn">
              <img src="/assets/images/contact.png" alt="" />
              <span>Contact Us</span>
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
              <div class="section-title white-title">
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
          <div class="secureQr-wrapper">
            <div class="secureQr-img">
              <img src="/assets/images/secureQR.png" alt="">
            </div>
            <div class="secureQr-content">
              <div class="section-title-wrapper is-white">
                <h2 class="section-title">HOW WE PROVIDE YOU SECURE ALERTS</h2>
              </div>
            </div>
          </div>
          <p class="secureQr-text">Respo QR Codes™ is a service that allows you to create tags, each with a unique ID acting as a dedicated mobile number for the item it's attached to.</p>
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

  // Initialize owl carousel after DOM is ready
  setTimeout(() => {
    if (window.$ && window.$('.main-slider-two__carousel').length) {
      window.$('.main-slider-two__carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        smartSpeed: 900,
        autoplay: true,
        autoplayTimeout: 4500,
        autoplaySpeed: 900,
        navSpeed: 900,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        stagePadding: 0,
        touchDrag: true,
        mouseDrag: true,
        navText: [
          '<span class="fa fa-angle-left"></span>',
          '<span class="fa fa-angle-right"></span>'
        ],
        responsive: {
          0: {
            items: 1,
            nav: false,
            dots: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut'
          },
          768: {
            items: 1,
            nav: true,
            dots: false
          },
          1200: {
            items: 1,
            nav: true,
            dots: false
          }
        }
      });
    }
  }, 100);
});
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.page-wrapper {
  width: 100%;
  max-width: 100vw;
  overflow-x: hidden;
}

/* Main Slider Responsive */
.main-slider-one {
  position: relative;
  width: 100%;
  overflow: hidden;
  background: #fecc00;
}

.main-slider-one__single {
  position: relative;
  min-height: 500px;
  display: flex;
  align-items: center;
  overflow: visible;
}

.main-slider-one--two-img {
  position: absolute;
  right: 2%;
  top: 50%;
  transform: translateY(-50%);
  width: 50%;
  max-width: 500px;
  z-index: 5;
  pointer-events: none;
}

.main-slider-one--two-img img {
  width: 100%;
  height: auto;
  max-height: 450px;
  object-fit: contain;
  display: block;
}

.image-layer {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1;
  background-color: #fecc00;
}

.main-slider-one__content {
  position: relative;
  z-index: 10;
  padding: 3rem 2rem;
  max-width: 48%;
}

.main-slider-one__content .title h2 {
  font-size: clamp(1.8rem, 4vw, 3.2rem);
  line-height: 1.3;
  margin-bottom: 1.5rem;
  color: #000;
  font-weight: 700;
}

.main-slider-one__content .text p {
  font-size: clamp(1rem, 1.8vw, 1.2rem);
  line-height: 1.7;
  color: #333;
  max-width: 500px;
}

/* Owl Carousel Controls */
.owl-carousel .owl-nav button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(254, 204, 0, 0.8) !important;
  color: #000 !important;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  font-size: 24px;
  transition: all 0.3s ease;
  z-index: 100;
}

.owl-carousel .owl-nav button:hover {
  background: #fecc00 !important;
}

.owl-carousel .owl-nav button.owl-prev {
  left: 20px;
}

.owl-carousel .owl-nav button.owl-next {
  right: 20px;
}

.owl-carousel .owl-dots {
  text-align: center;
  padding: 20px 0;
}

.owl-carousel .owl-dots .owl-dot {
  display: inline-block;
  width: 12px;
  height: 12px;
  margin: 0 5px;
  background: #ddd;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.owl-carousel .owl-dots .owl-dot.active {
  background: #fecc00;
  width: 30px;
  border-radius: 6px;
}

/* Sections Responsive */
.respo-app,
.call-back-area,
.about-area,
.services-area,
.choose-area,
.secureQr,
.why-choose {
  padding: 40px 20px;
  width: 100%;
}

/* Call Back Area Specific */
.call-back-area {
  background: #fecc00;
}

.download-app {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  flex-wrap: wrap;
}

.download-app a {
  display: inline-block;
  transition: transform 0.3s ease;
}

.download-app a:hover {
  transform: scale(1.05);
}

.download-app img {
  height: 50px;
  width: auto;
  display: inline-block;
}

.contact-main {
  display: flex;
  align-items: center;
  justify-content: center;
}

.contact-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 12px 30px;
  background: #f8f9fa;
  color: #000;
  text-decoration: none;
  border-radius: 50px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  border: 2px solid #f8f9fa;
}

.contact-btn:hover {
  background: #000;
  color: #fecc00;
  border-color: #000;
}

.contact-btn img {
  width: 24px;
  height: 24px;
  display: inline-block;
}

.contact-btn span {
  white-space: nowrap;
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -15px;
}

[class*="col-"] {
  padding: 0 15px;
  width: 100%;
}

/* Images Responsive */
img {
  max-width: 100%;
  height: auto;
  display: block;
}

.parallax-img {
  position: relative;
  left: 25px;
}

.respo-app__img1-inner img,
.about-img-wrap img,
.choose-img-wrap img,
.services-thumb img {
  width: 100%;
  height: auto;
}


/* Mobile First - up to 767px */
@media (max-width: 767px) {
  .main-slider-one__single {
    min-height: 300px;
    justify-content: center;
  }

  .main-slider-one--two-img {
    position: relative;
    width: 100%;
    max-width: 200px;
    right: auto;
    top: auto;
    transform: none;
    margin: 20px auto 0;
    display: block;
  }

  .main-slider-one--two-img img {
    max-height: 180px;
  }

  .main-slider-one__content {
    padding: 1.5rem 1rem;
    max-width: 100%;
    text-align: center;
  }

  .main-slider-one__content .title h2 br {
    display: none;
  }
  
  .main-slider-one__content .text {
    display: flex;
    justify-content: center;
  }

  .main-slider-one__content .text p {
    max-width: 100%;
  }

  .owl-carousel .owl-nav button {
    display: none !important;
  }

  .owl-carousel .owl-dots {
    display: block !important;
  }

  .respo-app,
  .call-back-area,
  .about-area,
  .services-area,
  .choose-area,
  .secureQr,
  .why-choose {
    padding: 30px 15px;
  }

  .row {
    margin: 0;
  }

  [class*="col-"] {
    padding: 15px 0;
  }

  .services-item,
  .why-choose__single {
    margin-bottom: 20px;
  }

  .download-app,
  .contact-main {
    margin-bottom: 20px;
  }

  .download-app {
    flex-direction: column;
    gap: 15px;
  }

  .download-app a {
    display: block;
    margin: 0;
  }

  .download-app img {
    height: 45px;
    margin: 0 auto;
  }

  .contact-main {
    margin-top: 0 !important;
  }

  .contact-btn {
    padding: 10px 20px;
    font-size: 14px;
  }

  .contact-btn img {
    width: 20px;
    height: 20px;
  }
}

/* Tablet - 768px to 991px */
@media (min-width: 768px) {
  .main-slider-one__single {
    min-height: 500px;
  }

  .main-slider-one--two-img {
    position: absolute;
    width: 45%;
    max-width: 400px;
    right: 3%;
    top: 50%;
    transform: translateY(-50%);
  }

  .main-slider-one--two-img img {
    max-height: 420px;
  }

  .main-slider-one__content {
    max-width: 50%;
    text-align: left;
    padding: 2.5rem 1.5rem;
  }

  .respo-app,
  .call-back-area,
  .about-area,
  .services-area,
  .choose-area,
  .secureQr,
  .why-choose {
    padding: 50px 30px;
  }

  .col-sm-8 {
    width: 66.666%;
    flex: 0 0 66.666%;
  }

  .col-md-6 {
    width: 50%;
    flex: 0 0 50%;
  }
}

/* Desktop - 992px and up */
@media (min-width: 992px) {
  .main-slider-one__single {
    min-height: 580px;
  }

  .main-slider-one--two-img {
    position: absolute;
    width: 48%;
    max-width: 500px;
    right: 2%;
    top: 50%;
    transform: translateY(-50%);
  }

  .main-slider-one--two-img img {
    max-height: 480px;
  }

  .main-slider-one__content {
    max-width: 48%;
    padding: 3rem 2rem;
  }

  .respo-app,
  .call-back-area,
  .about-area,
  .services-area,
  .choose-area,
  .secureQr,
  .why-choose {
    padding: 80px 40px;
  }

  .col-lg-4 {
    width: 33.333%;
    flex: 0 0 33.333%;
  }

  .col-lg-6 {
    width: 50%;
    flex: 0 0 50%;
  }

  .col-lg-8 {
    width: 66.666%;
    flex: 0 0 66.666%;
  }

  .owl-carousel .owl-dots {
    display: none !important;
  }

  .owl-carousel .owl-nav button {
    display: block !important;
  }
}

/* Large Desktop - 1200px and up */
@media (min-width: 1200px) {
  .main-slider-one__single {
    min-height: 620px;
  }

  .main-slider-one--two-img {
    position: absolute;
    width: 50%;
    max-width: 580px;
    right: 2%;
    top: 50%;
    transform: translateY(-50%);
  }

  .main-slider-one--two-img img {
    max-height: 520px;
  }

  .respo-app,
  .call-back-area,
  .about-area,
  .services-area,
  .choose-area,
  .secureQr,
  .why-choose {
    padding: 100px 60px;
  }

  .col-xl-3 {
    width: 25%;
    flex: 0 0 25%;
  }

  .col-xl-6 {
    width: 50%;
    flex: 0 0 50%;
  }

  .col-xl-8 {
    width: 66.666%;
    flex: 0 0 66.666%;
  }

  .col-xl-12 {
    width: 100%;
    flex: 0 0 100%;
  }
}

/* Extra Large Desktop - 1400px and up */
@media (min-width: 1400px) {
  .container {
    max-width: 1320px;
  }

  .main-slider-one__single {
    min-height: 650px;
  }
}

.mobile-nav__wrapper.expanded {
  visibility: visible;
}

.chatbot.show {
  transform: translateY(0);
  opacity: 1;
}

/* Secure QR Section Styling */
.secureQr-wrapper {
  display: flex;
  gap: 20px;
  align-items: center;
  margin-bottom: 5px;
}

.secureQr-img {
  flex: 0 0 12%;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100px;
}

.secureQr-img img {
  max-width: 100%;
  height: auto;
  max-height: 100px;
  object-fit: contain;
}

.secureQr-content {
  flex: 0 0 70%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.secureQr-text {
  text-align: center;
  width: 100%;
  font-size: 16px;
  line-height: 1.6;
  color: #333;
  margin: 0;
  padding: 0 15px;
}

/* Tablet - 768px to 991px */
@media (min-width: 768px) and (max-width: 991px) {
  .secureQr-wrapper {
    flex-direction: column;
    gap: 20px;
  }

  .secureQr-img,
  .secureQr-content {
    flex: 0 0 100%;
  }

  .secureQr-img {
    min-height: 250px;
  }

  .secureQr-img img {
    max-height: 250px;
  }
}

/* Mobile First - up to 767px */
@media (max-width: 767px) {
  .secureQr-wrapper {
    flex-direction: column;
    gap: 15px;
  }

  .secureQr-img,
  .secureQr-content {
    flex: 0 0 100%;
  }

  .secureQr-img {
    min-height: 100px;
  }

  .secureQr-img img {
    max-height: 200px;
  }

  .section-title {
    font-size: 18px !important;
  }

  .secureQr-text {
    font-size: 14px;
    padding: 0 10px;
  }
}
</style>
