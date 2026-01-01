<template>
  <div class="page-wrapper">
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />
    <section class="container-main forms">
      <div class="form signup">
        <div class="form-content">
          <header>Signup</header>
          
          <!-- Registration Method Toggle -->
          <div class="registration-toggle">
            <button 
              type="button"
              :class="['toggle-btn', { active: regMethod === 'email' }]"
              @click="regMethod = 'email'; resetForm()"
            >
              <i class="fas fa-envelope"></i> Email
            </button>
            <button 
              type="button"
              :class="['toggle-btn', { active: regMethod === 'phone' }]"
              @click="regMethod = 'phone'; resetForm()"
            >
              <i class="fas fa-mobile"></i> Phone
            </button>
          </div>

          <form @submit.prevent="submit">
            <!-- Name Field (Always Visible) -->
            <div class="field input-field">
              <input v-model="name" type="text" placeholder="Enter Your Name" class="input" required />
              <i class="icon-form fas fa-user"></i>
            </div>

            <!-- Email Registration Fields -->
            <template v-if="regMethod === 'email'">
              <div class="field input-field">
                <input v-model="email" type="email" placeholder="Enter Your Email" class="input" required />
                <i class="icon-form fas fa-envelope"></i>
              </div>

              <div class="field input-field">
                <input v-model="password" :type="showPw ? 'text' : 'password'" placeholder="Password (min 8 chars)" class="password" required />
                <i class="icon-form fas fa-lock"></i>
                <i :class="showPw ? 'bx bx-show' : 'bx bx-hide'" class="eye-icon" @click="showPw = !showPw"></i>
              </div>

              <div class="field input-field">
                <input v-model="confirm" :type="showConfirm ? 'text' : 'password'" placeholder="Confirm Password" class="password" required />
                <i class="icon-form fas fa-lock"></i>
                <i :class="showConfirm ? 'bx bx-show' : 'bx bx-hide'" class="eye-icon" @click="showConfirm = !showConfirm"></i>
              </div>
            </template>

            <!-- Phone Registration Fields -->
            <template v-if="regMethod === 'phone'">
              <!-- Mobile Input only -->
              <div class="field input-field">
                <input 
                  v-model="mobile" 
                  type="tel" 
                  placeholder="Enter Mobile Number" 
                  class="input" 
                  required 
                />
                <i class="icon-form fas fa-mobile"></i>
              </div>
            </template>

            <!-- Terms & Conditions -->
            <div class="policy">
              <input v-model="terms" type="checkbox" style="width: auto;" required />
              <h3>I accept all terms & condition</h3>
            </div>

            <!-- Submit Button -->
            <div class="field button-field">
              <button :disabled="loading">
                {{ loading ? 'Creating Account...' : 'Sign Up' }}
              </button>
            </div>
          </form>

          <!-- OTP Verification Form for Phone Registration -->
          <div v-if="verificationPending && regMethod === 'phone'" style="margin-top:30px;padding:20px;background:#f8f9fa;border-radius:6px;border:1px solid #dee2e6;">
            <h3 style="margin-top:0;color:#333;"><i class="fas fa-key"></i> Verify Your Phone Number</h3>
            <p style="color:#666;margin:10px 0;">We sent an OTP to <strong>{{ mobile }}</strong></p>
            
            <form @submit.prevent="submitPhoneOTP" style="margin-top:20px;">
              <div class="field input-field">
                <input 
                  v-model="phoneOtp" 
                  type="text" 
                  placeholder="Enter 6-digit OTP" 
                  class="input" 
                  maxlength="6"
                  required 
                />
                <i class="icon-form fas fa-key"></i>
                <button 
                  type="button" 
                  class="resend-otp-btn" 
                  @click="resendPhoneOTP" 
                  :disabled="otpResendDisabled || otpSending"
                >
                  <i class="fas fa-redo"></i> {{ otpSending ? 'Resending...' : `Resend (${resendCountdown}s)` }}
                </button>
              </div>

              <div class="field button-field" style="margin-top:15px;">
                <button type="submit" :disabled="phoneOtpLoading || !phoneOtp">
                  {{ phoneOtpLoading ? 'Verifying...' : 'Verify Phone & Complete Registration' }}
                </button>
              </div>
            </form>

            <p v-if="otpError" style="color:#dc3545;margin-top:10px;padding:10px;background:#f8d7da;border-radius:4px;">
              <i class="fas fa-exclamation-circle"></i> {{ otpError }}
            </p>
          </div>
          <p v-if="error" style="color:#dc3545;margin-top:8px;padding:10px;background:#f8d7da;border-radius:4px;">
            <i class="fas fa-exclamation-circle"></i> {{ error }}
          </p>
          <p v-if="success" style="color:#155724;margin-top:8px;padding:10px;background:#d4edda;border-radius:4px;">
            <i class="fas fa-check-circle"></i> {{ success }}
          </p>
          <p v-if="otpSuccess" style="color:#155724;margin-top:8px;padding:10px;background:#d4edda;border-radius:4px;">
            <i class="fas fa-check-circle"></i> {{ otpSuccess }}
          </p>

          <!-- Verification Pending -->
          <div v-if="verificationPending" style="margin-top:15px;padding:15px;background:#cfe2ff;border-radius:4px;border-left:4px solid #0d6efd;">
            <p v-if="regMethod === 'email'" style="color:#084298;margin:0;">
              <i class="fas fa-info-circle"></i> 
              <strong>Verification Link Sent!</strong><br>
              Check your email at <strong>{{ email }}</strong> and click the verification link to activate your account.
            </p>
            <p v-else style="color:#084298;margin:0;">
              <i class="fas fa-info-circle"></i> 
              <strong>Phone Verification Required!</strong><br>
              We'll send an OTP to <strong>{{ mobile }}</strong>. You'll verify your phone on the next screen.
            </p>
          </div>

          <!-- Login Link -->
          <div class="form-link">
            <span>Already have an account? <a href="/login" class="link login-link">Login</a></span>
          </div>
        </div>
      </div>
    </section>
    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="register"
      @toggle-mobile="toggleMobileNav" 
      @toggle-chatbot="toggleChatbot" 
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HeaderNav from './HeaderNav.vue';
import FooterNav from './FooterNav.vue';

const regMethod = ref('email');
const name = ref('');
const email = ref('');
const password = ref('');
const confirm = ref('');
const mobile = ref('');
const phoneOtp = ref('');
const terms = ref(false);
const showPw = ref(false);
const showConfirm = ref(false);
const loading = ref(false);
const phoneOtpLoading = ref(false);
const otpSending = ref(false);
const otpResendDisabled = ref(false);
const resendCountdown = ref(60);
const error = ref('');
const success = ref('');
const otpError = ref('');
const verificationPending = ref(false);
const mobileNavOpen = ref(false);
const chatbotOpen = ref(false);
const isLoggedIn = ref(false);

const resetForm = () => {
  name.value = '';
  email.value = '';
  mobile.value = '';
  phoneOtp.value = '';
  password.value = '';
  confirm.value = '';
  terms.value = false;
  error.value = '';
  success.value = '';
  otpError.value = '';
  verificationPending.value = false;
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

const resendPhoneOTP = async () => {
  otpError.value = '';
  otpSending.value = true;

  try {
    const res = await fetch('/api/v1/send-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ mobile: mobile.value })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to resend OTP');
    
    success.value = `OTP resent to ${mobile.value}`;
    startResendCountdown();
  } catch (e) {
    otpError.value = e.message;
  } finally {
    otpSending.value = false;
  }
};

const submitPhoneOTP = async () => {
  otpError.value = '';
  phoneOtpLoading.value = true;

  if (!phoneOtp.value || phoneOtp.value.length !== 6) {
    otpError.value = 'Please enter a valid 6-digit OTP';
    phoneOtpLoading.value = false;
    return;
  }

  try {
    const res = await fetch('/api/v1/verify-registration-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({
        mobile: mobile.value,
        otp: phoneOtp.value
      })
    });

    const data = await res.json();
    
    if (!res.ok) throw new Error(data.message || 'OTP verification failed');
    
    // Store JWT token if provided
    if (data.token) {
      localStorage.setItem('jwt_token', data.token);
      localStorage.setItem('user', JSON.stringify(data.user));
    }
    
    success.value = 'Phone verified! Account created successfully.';
    setTimeout(() => {
      window.location.href = '/';
    }, 1500);
  } catch (e) {
    otpError.value = e.message;
  } finally {
    phoneOtpLoading.value = false;
  }
};

const submit = async () => {
  error.value = '';
  success.value = '';
  verificationPending.value = false;
  loading.value = true;
  
  // Validation
  if (!name.value || !terms.value) {
    error.value = 'Please fill in all required fields and accept terms';
    loading.value = false;
    return;
  }

  try {
    const payload = {
      name: name.value,
      registration_method: regMethod.value,
      terms: terms.value,
    };

    if (regMethod.value === 'email') {
      if (!email.value || !password.value || !confirm.value) {
        throw new Error('Please fill in all email registration fields');
      }
      
      if (password.value !== confirm.value) {
        throw new Error('Passwords do not match');
      }

      if (password.value.length < 8) {
        throw new Error('Password must be at least 8 characters');
      }

      payload.email = email.value;
      payload.password = password.value;
      payload.password_confirmation = confirm.value;
    } else {
      if (!mobile.value) {
        throw new Error('Please enter your mobile number');
      }
      if (mobile.value.length < 10) {
        throw new Error('Please enter a valid mobile number');
      }
      payload.mobile = mobile.value;
    }

    const res = await fetch('/api/v1/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify(payload)
    });

    const data = await res.json();
    
    if (!res.ok) throw new Error(data.message || 'Registration failed');
    
    verificationPending.value = true;
    if (regMethod.value === 'email') {
      success.value = 'Account created! Check your email for verification link.';
    } else {
      // For phone registration, automatically send OTP
      success.value = 'Phone number submitted! Sending OTP...';
      await sendPhoneOTP();
    }
  } catch (e) {
    error.value = e.message;
  } finally {
    loading.value = false;
  }
};

const sendPhoneOTP = async () => {
  otpError.value = '';
  otpSending.value = true;

  try {
    const res = await fetch('/api/v1/send-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ mobile: mobile.value })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to send OTP');
    
    success.value = `OTP sent to ${mobile.value}`;
    startResendCountdown();
  } catch (e) {
    otpError.value = e.message;
    error.value = e.message;
  } finally {
    otpSending.value = false;
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
.registration-toggle {
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
}
</style>

<style scoped>
.container-main { max-width: 520px; margin: 24px auto; }
.button-field button[disabled] { opacity: .6; }
</style>
