<template>
  <div class="page-wrapper">
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />
    
    <section class="container-main forms">
      <div class="form forgot-password">
        <div class="form-content">
          <header>Forgot Password</header>
          
          <div v-if="!submitted">
            <form @submit.prevent="sendResetLink">
              <div class="field input-field">
                <input v-model="email" type="email" placeholder="Enter Your Email" class="input" />
                <i class="icon-form fas fa-envelope"></i>
              </div>
              <div class="field button-field">
                <button :disabled="loading">{{ loading ? 'Sending...' : 'Send Reset Link' }}</button>
              </div>
            </form>
            <p v-if="error" style="color:red;margin-top:8px">{{ error }}</p>
          </div>

          <div v-else class="success-message">
            <p style="color:green;margin-top:8px">
              <i class="fas fa-check-circle"></i>
              Password reset link has been sent to your email. Please check your inbox and follow the link to reset your password.
            </p>
          </div>

          <div class="form-link">
            <span>Remember your password? <a href="/login" class="link login-link">Login</a></span>
          </div>
        </div>
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="forgot-password"
      @toggle-mobile="toggleMobileNav" 
      @toggle-chatbot="toggleChatbot" 
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HeaderNav from './HeaderNav.vue';
import FooterNav from './FooterNav.vue';

const email = ref('');
const loading = ref(false);
const error = ref('');
const submitted = ref(false);
const mobileNavOpen = ref(false);
const chatbotOpen = ref(false);
const isLoggedIn = ref(false);

const sendResetLink = async () => {
  error.value = '';
  loading.value = true;
  try {
    const res = await fetch('/forgot-password', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ email: email.value })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to send reset link');
    
    submitted.value = true;
  } catch (e) {
    error.value = e.message;
  } finally {
    loading.value = false;
  }
};

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
.container-main { max-width: 520px; margin: 24px auto; }
.button-field button[disabled] { opacity: .6; }
.success-message { text-align: center; padding: 20px; }
</style>
