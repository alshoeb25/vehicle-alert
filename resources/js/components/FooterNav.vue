<template>
  <footer class="footer">
    <div class="footer__bg" style="background:#fecc00;"></div>
    <div class="footer__top">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="footer__top-wrapper">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                  <div class="footer-widget__column footer-widget__about">
                    <h2>Respo QR Codes</h2>
                    <p class="footer-widget__about-text">Welcome to Inferlogic Consultancy Services Pvt Ltd., a cutting-edge IT solutions provider driven by innovation and expertise.</p>
                    <div>
                      <ul style="margin-top: 18px;">
                        <li style="float: left; margin-right: 18px;"><a href="#"><img src="/assets/images/google-play.png" alt="" style="width: 140px;"></a></li>
                        <li><a href="#"><img src="/assets/images/app_store.png" alt="" style="width: 140px;"></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8">
                  <div class="footer-widget__column footer-widget__about">
                    <div class="row">
                      <div class="col-lg-3 col-md-6 col-sm-8 text-center">
                        <a href="#"><img src="/assets/images/nag.png" alt=""><p>Nagpur</p></a>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-8 text-center">
                        <a href="#"><img src="/assets/images/international.png" alt=""><p>International</p></a>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-8 text-center">
                        <a href="#"><img src="/assets/images/phone.png" alt=""><p>+91 8000 15 3003</p></a>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-8 text-center">
                        <a href="#"><img src="/assets/images/mail.png" alt=""><p>wecare@inferlogics.com</p></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer__bottom">
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="footer__bottom-inner">
              <div class="footer__bottom-text">
                <p>Copyright © 2024 All Rights Reserved Inferlogic Consultancy Services Pvt Ltd.</p>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="social-link">
              <ul>
                <li><a href="https://www.facebook.com/profile.php?id=61555171866673" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/respoqrcodes/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="https://twitter.com/RespoQRCodes" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div class="mobile-nav__wrapper" :class="{ 'expanded': mobileNavOpen }">
    <div class="mobile-nav__overlay mobile-nav__toggler" @click="$emit('toggle-mobile')"></div>
    <div class="mobile-nav__content">
      <span class="mobile-nav__close mobile-nav__toggler" @click="$emit('toggle-mobile')"><i class="fa fa-times"></i></span>
      <div class="logo-box">
        <a href="/" aria-label="logo image"><img src="/assets/images/logo_footer.png" width="200" alt="" /></a>
      </div>
      <div class="mobile-nav__container">
        <ul class="main-menu__list">
          <li :class="{ 'current': currentPage === 'home' }"><a href="/">Home</a></li>
          <li :class="{ 'current': currentPage === 'about' }"><a href="/about">About Us</a></li>
          <li :class="{ 'current': currentPage === 'shop' }"><a href="/shop">Shop</a></li>
          <li :class="{ 'current': currentPage === 'how-it-works' }"><a href="/how-it-works">How It Works</a></li>
          <li :class="{ 'current': currentPage === 'contact' }"><a href="/contact">Contact</a></li>
          <li :class="{ 'current': currentPage === 'faq' }"><a href="/faq">FAQ'S</a></li>
        </ul>
      </div>
      <ul class="mobile-nav__contact list-unstyled">
        <li><i class="fa fa-envelope"></i><a href="#">wecare@inferlogics.com</a></li>
        <li><i class="fa fa-phone-alt"></i><a href="#">+91 8000 15 3003</a></li>
      </ul>
      <div class="mobile-nav__top">
        <div class="mobile-nav__social">
          <a href="https://www.facebook.com/profile.php?id=61555171866673" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/respoqrcodes/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://twitter.com/RespoQRCodes" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        </div>
      </div>
    </div>
  </div>

  <button class="chatbot-toggler" @click="$emit('toggle-chatbot')">
    <span class="fa-solid fa-message"></span>
    <span class="fa-solid fa-xmark"></span>
  </button>
  <div class="chatbot" :class="{ 'show': chatbotOpen }">
    <header>
      <h2>Chatbot</h2>
      <span class="close-btn fa-solid fa-xmark" @click="$emit('toggle-chatbot')"></span>
    </header>
    <ul class="chatbox">
      <li class="chat incoming">
        <p>Hi there<br>How can I help you today?</p>
      </li>
    </ul>
    <div class="chat-input">
      <textarea placeholder="Enter a message..." spellcheck="false"></textarea>
      <span class="fa-solid fa-paper-plane"></span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  mobileNavOpen: { type: Boolean, default: false },
  chatbotOpen: { type: Boolean, default: false },
  currentPage: { type: String, default: 'home' }
});
defineEmits(['toggle-mobile', 'toggle-chatbot']);
</script>

<style scoped>
/* Footer responsive container */
.footer { width: 100%; }
.footer .container { width: 100%; padding-left: 16px; padding-right: 16px; }
.footer__top .row, .footer__bottom .row { display: flex; flex-wrap: wrap; }

/* Mobile nav panel */
.mobile-nav__wrapper { position: fixed; inset: 0; z-index: 10000; display: none; }
.mobile-nav__wrapper.expanded { display: block; }
.mobile-nav__overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.4); }
.mobile-nav__content { position: absolute; top: 0; right: 0; width: 86%; max-width: 360px; height: 100%; background: #fff; padding: 20px; overflow-y: auto; box-shadow: -6px 0 20px rgba(0,0,0,0.2); }
.mobile-nav__container .main-menu__list { display: flex; flex-direction: column; gap: 12px; }
.mobile-nav__close { position: absolute; top: 14px; right: 14px; cursor: pointer; }

/* Chatbot button and panel responsiveness */
.chatbot-toggler { position: fixed; bottom: 16px; right: 16px; z-index: 10001; display: grid; place-items: center; width: 48px; height: 48px; border-radius: 50%; background: #fecc00; color: #1a1a1a; border: 1px solid #f0c200; }
.chatbot { position: fixed; bottom: 80px; right: 16px; width: 92%; max-width: 360px; background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; box-shadow: 0 10px 24px rgba(0,0,0,0.18); display: none; z-index: 10002; }
.chatbot.show { display: block; }
.chatbot header { display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-bottom: 1px solid #e5e7eb; }
.chatbox { list-style: none; padding: 12px; margin: 0; max-height: 42vh; overflow-y: auto; }
.chat-input { display: flex; align-items: center; gap: 8px; padding: 10px 12px; border-top: 1px solid #e5e7eb; }
.chat-input textarea { flex: 1; min-height: 42px; resize: vertical; }

@media (min-width: 992px) {
  .mobile-nav__content { width: 420px; }
}
</style>
