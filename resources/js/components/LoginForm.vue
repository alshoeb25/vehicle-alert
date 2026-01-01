<template>
  <div class="page-wrapper">
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />

    <section class="container-main forms">
      <div class="form login">
        <div class="form-content">
          <header>Login</header>
          
          <!-- Login Method Toggle -->
          <div class="login-toggle">
            <button 
              type="button"
              :class="['toggle-btn', { active: loginMethod === 'password' }]"
              @click="loginMethod = 'password'; resetForm()"
            >
              <i class="fas fa-lock"></i> Email/Password
            </button>
            <button 
              type="button"
              :class="['toggle-btn', { active: loginMethod === 'otp' }]"
              @click="loginMethod = 'otp'; resetForm()"
            >
              <i class="fas fa-key"></i> Phone/OTP
            </button>
          </div>

          <form @submit.prevent="submit">
            <!-- Email/Password Login Method -->
            <template v-if="loginMethod === 'password'">
              <div class="field input-field">
                <input v-model="email" type="email" placeholder="Email Address" class="input" required />
                <i class="icon-form fas fa-envelope"></i>
              </div>
              <div class="field input-field">
                <input v-model="password" :type="show ? 'text' : 'password'" placeholder="Password" class="password" required />
                <i class="icon-form fas fa-lock"></i>
                <i :class="show ? 'bx bx-show' : 'bx bx-hide'" class="eye-icon" @click="show = !show"></i>
              </div>
              <div class="row form-link">
                <div class="policy col">
                  <input v-model="remember" type="checkbox" style="width: auto;" />
                  <h3>Remember Me</h3>
                </div>
                <a href="/forgot-password" class="col forgot-pass">Forgot password?</a>
              </div>
            </template>

            <!-- Phone/OTP Login Method -->
            <template v-if="loginMethod === 'otp'">
              <div class="field input-field">
                <input 
                  v-model="otpMobile" 
                  type="tel" 
                  placeholder="Mobile Number" 
                  class="input" 
                  required 
                />
                <i class="icon-form fas fa-mobile"></i>
                <a 
                  href="#"
                  class="send-otp-link"
                  @click.prevent="sendLoginOTP"
                  :class="{ disabled: !canSendLogin || otpSending }"
                  v-if="!otpSent"
                >
                  <i class="fas fa-paper-plane"></i> {{ otpSending ? 'Sending...' : 'Send OTP' }}
                </a>
                <a 
                  href="#"
                  class="resend-otp-link"
                  @click.prevent="sendLoginOTP"
                  :class="{ disabled: otpResendDisabled || otpSending }"
                  v-else
                >
                  <i class="fas fa-redo"></i> {{ otpSending ? 'Resending...' : `Resend (${resendCountdown}s)` }}
                </a>
              </div>

              <!-- OTP Field with Resend -->
              <div v-if="otpSent" class="field input-field">
                <input 
                  v-model="otpCode" 
                  type="text" 
                  placeholder="Enter 6-digit OTP" 
                  class="input" 
                  maxlength="6"
                  required 
                />
                <i class="icon-form fas fa-key"></i>
              </div>
            </template>

            <!-- Login Button -->
            <div class="field button-field">
              <button :disabled="loading || (loginMethod === 'otp' && otpSent && !otpCode)">
                {{ loading ? 'Logging in...' : 'Login' }}
              </button>
            </div>
          </form>

          <!-- Messages -->
          <p v-if="error" style="color:#dc3545;margin-top:8px;padding:10px;background:#f8d7da;border-radius:4px;">
            <i class="fas fa-exclamation-circle"></i> {{ error }}
          </p>
          <p v-if="otpSuccess" style="color:#155724;margin-top:8px;padding:10px;background:#d4edda;border-radius:4px;">
            <i class="fas fa-check-circle"></i> {{ otpSuccess }}
          </p>

          <!-- Sign Up Link -->
          <div class="form-link">
            <span>Don't have an account? <a href="/register" class="link signup-link">Sign Up</a></span>
          </div>
        </div>

        <!-- Divider -->
        <div class="line"></div>

        <!-- Social Login -->
        <div class="media-options">
          <a href="/auth/facebook/redirect" class="field facebook">
            <i class='bx bxl-facebook facebook-icon'></i>
            <span>Login with Facebook</span>
          </a>
        </div>
        <div class="media-options">
          <a href="/auth/google/redirect" class="field google">
            <img src="/assets/images/google.png" alt="" class="google-img" />
            <span>Login with Google</span>
          </a>
        </div>
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="login"
      @toggle-mobile="toggleMobileNav" 
      @toggle-chatbot="toggleChatbot" 
    />
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import HeaderNav from './HeaderNav.vue';
import FooterNav from './FooterNav.vue';

const loginMethod = ref('password');
const email = ref('');
const password = ref('');
const otpMobile = ref('');
const otpCode = ref('');
const remember = ref(false);
const show = ref(false);
const loading = ref(false);
const otpSending = ref(false);
const otpSent = ref(false);
const canSendLogin = ref(false);
const otpResendDisabled = ref(false);
const resendCountdown = ref(60);
const error = ref('');
const mobileNavOpen = ref(false);
const chatbotOpen = ref(false);
const isLoggedIn = ref(false);

const validateMobileNumber = (mobile) => {
  return mobile && mobile.length >= 10;
};

watch(otpMobile, (newValue) => {
  canSendLogin.value = validateMobileNumber(newValue);
});

const sendLoginOTP = async () => {
  error.value = '';
  otpSending.value = true;

  if (!validateMobileNumber(otpMobile.value)) {
    error.value = 'Please enter a valid mobile number (10+ digits)';
    otpSending.value = false;
    return;
  }

  try {
    const res = await fetch('/api/v1/send-login-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ mobile: otpMobile.value })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to send OTP');
    
    otpSent.value = true;
    startResendCountdown();
  } catch (e) {
    error.value = e.message;
  } finally {
    otpSending.value = false;
  }
};

const startResendCountdown = () => {
  otpResendDisabled.value = true;
  resendCountdown.value = 60;

  const interval = setInterval(() => {
    resendCountdown.value--;
    if (resendCountdown.value <= 0) {
      clearInterval(interval);
      otpResendDisabled.value = false;
      resendCountdown.value = 60;
    }
  }, 1000);
};

const resetForm = () => {
  email.value = '';
  password.value = '';
  otpMobile.value = '';
  otpCode.value = '';
  error.value = '';
  otpSent.value = false;
  otpResendDisabled.value = false;
  resendCountdown.value = 60;
  canSendLogin.value = false;
};

const submit = async () => {
  error.value = '';
  loading.value = true;

  try {
    let payload = { remember: remember.value };
    
    if (loginMethod.value === 'password') {
      if (!email.value || !password.value) {
        throw new Error('Please enter email and password');
      }
      payload.email = email.value;
      payload.password = password.value;
    } else {
      if (!otpMobile.value || !otpCode.value) {
        throw new Error('Please enter mobile number and OTP');
      }
      payload.mobile = otpMobile.value;
      payload.otp = otpCode.value;
      payload.login_method = 'otp';
    }

    const res = await fetch('/api/v1/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify(payload)
    });

    if (res.redirected) {
      window.location.href = res.url;
      return;
    }

    const data = await res.json();
    
    // Handle verification required responses
    if (res.status === 403 && data.verification_required) {
      if (data.verification_type === 'email') {
        error.value = data.message || 'Email verification required. Check your email for verification link.';
      } else if (data.verification_type === 'mobile') {
        error.value = data.message || 'Mobile verification required. Please verify with OTP.';
      } else {
        error.value = data.message;
      }
      loading.value = false;
      return;
    }
    
    if (!res.ok) throw new Error(data.message || 'Login failed');
    
    // Store JWT token if provided
    if (data.token) {
      localStorage.setItem('jwt_token', data.token);
      localStorage.setItem('user', JSON.stringify(data.user));
    }
    
    window.location.href = '/';
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
    const res = await fetch('/api/v1/logout', {
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
.login-toggle {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
  margin-top: 20px;
}

.toggle-btn {
  flex: 1;
  padding: 10px 15px;
  border: 2px solid #ddd;
  background: white;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: all 0.3s;
}

.toggle-btn:hover {
  border-color: #fecc00;
}

.toggle-btn.active {
  background: #fecc00;
  color: white;
  border-color: #fecc00;
}

.toggle-btn i {
  margin-right: 5px;
}

.send-otp-btn,
.resend-otp-btn {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: #28a745;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 12px;
  white-space: nowrap;
  transition: all 0.3s;
}

.send-otp-btn:hover:not(:disabled),
.resend-otp-btn:hover:not(:disabled) {
  background: #218838;
}

.send-otp-btn:disabled,
.resend-otp-btn:disabled {
  background: #ccc;
  cursor: not-allowed;
  opacity: 0.7;
}

.send-otp-btn i,
.resend-otp-btn i {
  margin-right: 5px;
}

.field {
  position: relative;
}

.container-main { 
  max-width: 520px; 
  margin: 24px auto; 
}

.button-field button[disabled] { 
  opacity: .6; 
  cursor: not-allowed;
  margin-top: 30px;
}

/* Small link styles for Send/Resend OTP placed at bottom-right of the mobile input field */
.send-otp-link,
.resend-otp-link {
  position: absolute;
  right: 0;
  bottom: -30px; /* sits just below the input, aligned right */
  font-size: 12px;
  color: #000;
  text-decoration: underline;
  cursor: pointer;
}

.send-otp-link.disabled,
.resend-otp-link.disabled {
  color: #6c757d;
  pointer-events: none;
  text-decoration: none;
  opacity: 0.6;
}
</style>

<style scoped>
.container-main { max-width: 520px; margin: 24px auto; }
.button-field button[disabled] { opacity: .6; }
.button-field{ margin-top: 30px; }
</style>
