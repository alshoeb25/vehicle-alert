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
                <h2>Contact Us</h2>
                <div class="page-header__menu">
                  <ul>
                    <li><a href="/">Home</a></li>
                    <li>Contact Us</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="contact" class="contact-area mb-165 mt-155">
      <div class="contact-wrapper position-relative">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-12">
              <div class="contact-wrapper pb-20">
                <div class="title text-md-center text-lg-left">
                  <h3 class="f-700">Contact Us</h3>
                </div>
                <ul class="contact-info-content d-md-flex justify-content-between d-lg-block mt-50">
                  <li class="contact-location s-contact text-md-center text-lg-left mb-35 transition-3 d-lg-flex d-flex d-md-block">
                    <div class="contact-icon d-inline-block text-center primary-bg mr-30">
                      <span class="d-inline-block">
                        <i class="fa-solid fa-location-pin" style="font-size: 26px; color: #fecc00;"></i>
                      </span>
                    </div>
                    <div class="contact-text">
                      <h4 class="f-700 mb-2">Location</h4>
                      <p class="secondary-color mb-0">Nagpur, Maharashtra State</p>
                    </div>
                  </li>
                  <li class="contact-email s-contact text-md-center text-lg-left mb-35 transition-3 d-lg-flex d-flex d-md-block">
                    <div class="contact-icon d-inline-block text-center primary-bg mr-30">
                      <span class="d-inline-block">
                        <i class="fa-solid fa-envelope" style="font-size: 26px; color: #fecc00;"></i>
                      </span>
                    </div>
                    <div class="contact-text">
                      <h4 class="f-700 mb-2">Email</h4>
                      <p class="mb-0"><a class="secondary-color2 primary-hover d-block" href="#">wecare@inferlogics.com</a></p>
                    </div>
                  </li>
                  <li class="contact-phone s-contact text-md-center text-lg-left mb-40 transition-3 d-lg-flex d-flex d-md-block">
                    <div class="contact-icon d-inline-block text-center primary-bg mr-30">
                      <span class="d-inline-block">
                        <i class="fa-solid fa-phone" style="font-size: 26px; color: #fecc00;"></i>
                      </span>
                    </div>
                    <div class="contact-text">
                      <h4 class="f-700 mb-2">Phone</h4>
                      <p class="mb-0"><a class="secondary-color2 primary-hover d-block" href="#">+123 456 7890</a></p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-12">
              <div class="contact-wrapper">
                <div class="contact-form">
                  <div class="title px-md-5 px-lg-0 text-lg-left">
                    <h3 class="f-700 mb-40">Drop us a line</h3>
                    <p class="mb-20">We are at your disposal for any information you may need. Complete the fields below: We will reply within 24 working hours.</p>
                  </div>
                  <form @submit.prevent="submitContactForm" id="contact-form">
                    <div class="contact-info text-lg-left pt-20">
                      <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-15">
                          <input 
                            v-model="formData.name"
                            class="name w-100 theme-border pl-20 pt-15 pb-15 pr-10 form-color border-radius5 primary-font-family" 
                            type="text" 
                            name="inputName" 
                            id="inputName" 
                            placeholder="Your Name *" 
                            required
                            :disabled="isSubmitting"
                          >
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-15">
                          <input 
                            v-model="formData.email"
                            class="email w-100 theme-border pl-20 pt-15 pb-15 pr-10 form-color border-radius5 primary-font-family" 
                            type="email" 
                            name="inputEmail" 
                            id="inputEmail" 
                            placeholder="Your Email *" 
                            required
                            :disabled="isSubmitting"
                          >
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-15">
                          <input 
                            v-model="formData.phone"
                            class="phone w-100 theme-border pl-20 pt-15 pb-15 pr-10" 
                            type="text" 
                            name="inputPhone" 
                            id="inputPhone" 
                            placeholder="Your Phone"
                            :disabled="isSubmitting"
                          >
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-15">
                          <textarea 
                            v-model="formData.message"
                            class="massage w-100 primary-border pl-20 pt-20" 
                            name="inputMessage" 
                            id="inputMessage" 
                            placeholder="Your query *" 
                            required
                            :disabled="isSubmitting"
                          ></textarea>
                        </div>
                      </div>
                      <div class="my-btn mt-40">
                        <button 
                          class="btn text-uppercase f-18 f-700" 
                          type="submit"
                          :disabled="isSubmitting"
                        >
                          {{ isSubmitting ? 'Submitting...' : 'Submit' }}
                        </button>
                      </div>
                    </div>
                  </form>
                  <p class="form-message mt-20" :class="messageClass">{{ formMessage }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="contact"
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
const isSubmitting = ref(false);
const formMessage = ref('');
const messageClass = ref('');

const formData = ref({
  name: '',
  email: '',
  phone: '',
  message: '',
});

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

const submitContactForm = async (e) => {
  e.preventDefault();
  isSubmitting.value = true;
  formMessage.value = '';
  messageClass.value = '';

  try {
    const response = await fetch('/api/v1/contact', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify(formData.value)
    });

    const data = await response.json();

    if (response.ok || data.success) {
      formMessage.value = data.message || 'Thank you! Your message has been received. We will get back to you within 24 hours.';
      messageClass.value = 'success';
      
      // Reset form
      formData.value = {
        name: '',
        email: '',
        phone: '',
        message: '',
      };

      // Clear message after 5 seconds
      setTimeout(() => {
        formMessage.value = '';
        messageClass.value = '';
      }, 5000);
    } else {
      formMessage.value = data.message || 'An error occurred. Please try again.';
      messageClass.value = 'error';
    }
  } catch (error) {
    console.error('Form submission error:', error);
    formMessage.value = 'An error occurred while submitting your form. Please try again later.';
    messageClass.value = 'error';
  } finally {
    isSubmitting.value = false;
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

.form-message {
  padding: 14px 16px;
  border-radius: 6px;
  font-weight: 500;
  display: none;
  margin-top: 20px !important;
}

.form-message:not(:empty) {
  display: block;
}

.form-message.success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.form-message.error {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

input:disabled,
textarea:disabled,
button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>
