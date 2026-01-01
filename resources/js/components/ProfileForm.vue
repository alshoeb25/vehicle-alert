<template>
  <div class="page-wrapper">
    <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />
    
    <section class="container-main profile-section">
      <div class="profile-card">
        <div class="card-header">
          <div class="avatar"><i class="fas fa-user"></i></div>
          <div class="title-wrap">
            <h2>Profile Settings</h2>
            <button class="icon-btn small" @click="startEditName" aria-label="Edit profile">
              <i class="fas fa-pen"></i>
            </button>
            <p class="subtitle">Manage your personal info and account verification.</p>
          </div>
        </div>

        <!-- Alerts -->
        <transition name="fade">
          <div v-if="profileError || emailError || mobileError" class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ profileError || emailError || mobileError }}</span>
          </div>
        </transition>
        <transition name="fade">
          <div v-if="profileSuccess || emailSuccess || mobileSuccess" class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ profileSuccess || emailSuccess || mobileSuccess }}</span>
          </div>
        </transition>

        <!-- Profile Info Section -->
        <div class="section">
          <div class="section-head">
            <h3><i class="fas fa-id-card"></i> Profile Information</h3>
            <div class="chips">
              <span class="chip" :class="profile.email_verified ? 'ok' : 'warn'">
                <i class="fas" :class="profile.email_verified ? 'fa-check' : 'fa-exclamation' "></i>
                {{ profile.email_verified ? 'Email verified' : 'Email not verified' }}
              </span>
              <span class="chip" :class="profile.mobile_verified ? 'ok' : (profile.mobile ? 'warn' : 'muted')">
                <i class="fas" :class="profile.mobile_verified ? 'fa-check' : 'fa-exclamation' "></i>
                {{ profile.mobile_verified ? 'Mobile verified' : (profile.mobile ? 'Mobile not verified' : 'No mobile') }}
              </span>
            </div>
          </div>

          <!-- Name Row -->
          <div class="row">
            <div class="row-left">
              <span class="label">Full Name</span>
              <div v-if="!editingName" class="value">{{ profile.name || '-' }}</div>
              <div v-else class="edit-inline">
                <div class="input-wrap">
                  <i class="icon fas fa-user"></i>
                  <input v-model="profile.name" type="text" placeholder="Your full name" />
                </div>
              </div>
            </div>
            <div class="row-right">
              <button v-if="!editingName" class="icon-btn" @click="startEditName" aria-label="Edit name">
                <i class="fas fa-pen"></i>
              </button>
              <div v-else class="actions">
                <button class="btn btn-primary" :disabled="loadingProfile" @click="saveName">
                  <i class="fas fa-save"></i><span>{{ loadingProfile ? 'Saving...' : 'Save' }}</span>
                </button>
                <button class="btn btn-ghost" @click="cancelEditName">
                  <i class="fas fa-times"></i><span>Cancel</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- Email Section -->
        <div class="section">
          <div class="section-head">
            <h3><i class="fas fa-envelope"></i> Email Address</h3>
          </div>

          <div class="row email-row" :class="{ editing: editingEmail }">
            <div class="row-left">
              <span class="label">Email</span>
              <div v-if="!editingEmail" class="value"><i class="fas fa-at"></i> {{ profile.email }}</div>
              <div v-else class="edit-inline-group">
                <div class="input-wrap">
                  <i class="icon fas fa-envelope"></i>
                  <input v-model="newEmail" type="email" placeholder="name@example.com" />
                </div>
                <div class="actions inline-actions">
                  <button @click="updateEmail" :disabled="loadingEmail" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    <span>{{ loadingEmail ? 'Sending...' : 'Send Link' }}</span>
                  </button>
                  <button @click="cancelEditEmail" class="btn btn-ghost">
                    <i class="fas fa-times"></i>
                    <span>Cancel</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="row-right" v-if="!editingEmail">
              <button class="icon-btn" @click="startEditEmail" aria-label="Edit email">
                <i class="fas fa-pen"></i>
              </button>
            </div>
          </div>

          
        </div>

        <div class="divider"></div>

        <!-- Mobile Section -->
        <div class="section">
          <div class="section-head">
            <h3><i class="fas fa-mobile-alt"></i> Mobile Number</h3>
          </div>

          <div class="row">
            <div class="row-left">
              <span class="label">Mobile</span>
              <div v-if="!editingMobile" class="value"><i class="fas fa-hashtag"></i> {{ profile.mobile || 'Not set' }}</div>
              <div v-else class="edit-inline">
                <template v-if="!mobileOtpSent">
                  <label class="field">
                    <div class="input-wrap">
                      <i class="icon fas fa-mobile"></i>
                      <input v-model="newMobile" type="tel" placeholder="e.g. +1 555 000 1234" />
                    </div>
                  </label>
                </template>
                <template v-else>
                  <div class="notice ok"><i class="fas fa-check"></i> OTP sent to {{ newMobile }}</div>
                  <label class="field">
                    <div class="input-wrap">
                      <i class="icon fas fa-key"></i>
                      <input v-model="mobileOtp" type="text" placeholder="6-digit code" />
                    </div>
                  </label>
                </template>
              </div>
            </div>
            <div class="row-right">
              <button v-if="!editingMobile" class="icon-btn" @click="startEditMobile" aria-label="Edit mobile">
                <i class="fas fa-pen"></i>
              </button>
              <div v-else class="actions">
                <template v-if="!mobileOtpSent">
                  <button @click="sendMobileOTP" :disabled="loadingMobile || !newMobile" class="btn btn-primary">
                    <i class="fas fa-sms"></i>
                    <span>{{ loadingMobile ? 'Sending OTP...' : 'Send OTP' }}</span>
                  </button>
                </template>
                <template v-else>
                  <button @click="verifyMobileOTP" :disabled="loadingMobileVerify || !mobileOtp" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ loadingMobileVerify ? 'Verifying...' : 'Verify OTP' }}</span>
                  </button>
                </template>
                <button @click="cancelMobileEdit" class="btn btn-ghost">
                  <i class="fas fa-times"></i>
                  <span>Cancel</span>
                </button>
              </div>
            </div>
          </div>

          
        </div>
      </div>
    </section>

    <FooterNav 
      :mobile-nav-open="mobileNavOpen" 
      :chatbot-open="chatbotOpen" 
      current-page="profile"
      @toggle-mobile="toggleMobileNav" 
      @toggle-chatbot="toggleChatbot" 
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HeaderNav from './HeaderNav.vue';
import FooterNav from './FooterNav.vue';

const profile = ref({
  name: '',
  email: '',
  mobile: '',
  email_verified: false,
  mobile_verified: false,
});

const newEmail = ref('');
const newMobile = ref('');
const mobileOtp = ref('');
const editingName = ref(false);
const editingEmail = ref(false);
const editingMobile = ref(false);
const mobileOtpSent = ref(false);

const loading = ref(true);
const loadingProfile = ref(false);
const loadingEmail = ref(false);
const loadingMobile = ref(false);
const loadingMobileVerify = ref(false);

const profileError = ref('');
const profileSuccess = ref('');
const emailError = ref('');
const emailSuccess = ref('');
const mobileError = ref('');
const mobileSuccess = ref('');

const mobileNavOpen = ref(false);
const chatbotOpen = ref(false);
const isLoggedIn = ref(true);

const getProfile = async () => {
  try {
    const token = localStorage.getItem('jwt_token');
    const res = await fetch('/api/v1/profile', {
      headers: {
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      }
    });
    const data = await res.json();
    if (res.ok) {
      profile.value = data;
    }
  } catch (err) {
    console.error('Failed to fetch profile:', err);
  } finally {
    loading.value = false;
  }
};

// Inline edit helpers
const startEditName = () => { editingName.value = true; };
const cancelEditName = () => { editingName.value = false; };
const saveName = async () => { await updateProfile(); editingName.value = false; };

const startEditEmail = () => {
  newEmail.value = profile.value.email || '';
  editingEmail.value = true;
};
const cancelEditEmail = () => {
  editingEmail.value = false;
  newEmail.value = '';
  emailError.value = '';
  emailSuccess.value = '';
};

const startEditMobile = () => {
  newMobile.value = profile.value.mobile || '';
  editingMobile.value = true;
  mobileOtpSent.value = false;
  mobileError.value = '';
  mobileSuccess.value = '';
};

const updateProfile = async () => {
  profileError.value = '';
  profileSuccess.value = '';
  loadingProfile.value = true;

  try {
    const token = localStorage.getItem('jwt_token');
    const res = await fetch('/api/v1/profile/update', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ name: profile.value.name })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to update profile');
    profileSuccess.value = 'Profile updated successfully!';
  } catch (err) {
    profileError.value = err.message;
  } finally {
    loadingProfile.value = false;
  }
};

const updateEmail = async () => {
  emailError.value = '';
  emailSuccess.value = '';
  loadingEmail.value = true;

  try {
    const token = localStorage.getItem('jwt_token');
    const res = await fetch('/api/v1/profile/update-email', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ email: newEmail.value })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to update email');
    emailSuccess.value = 'Verification link sent to new email address!';
    setTimeout(() => {
      editingEmail.value = false;
      newEmail.value = '';
      emailSuccess.value = '';
      getProfile();
    }, 2000);
  } catch (err) {
    emailError.value = err.message;
  } finally {
    loadingEmail.value = false;
  }
};

const sendMobileOTP = async () => {
  mobileError.value = '';
  mobileSuccess.value = '';
  loadingMobile.value = true;

  try {
    const token = localStorage.getItem('jwt_token');
    const res = await fetch('/api/v1/profile/update-mobile', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ mobile: newMobile.value })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to send OTP');
    mobileOtpSent.value = true;
    mobileSuccess.value = 'OTP sent successfully!';
  } catch (err) {
    mobileError.value = err.message;
  } finally {
    loadingMobile.value = false;
  }
};

const verifyMobileOTP = async () => {
  mobileError.value = '';
  mobileSuccess.value = '';
  loadingMobileVerify.value = true;

  try {
    const token = localStorage.getItem('jwt_token');
    const res = await fetch('/api/v1/profile/verify-mobile', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ mobile: newMobile.value, otp: mobileOtp.value })
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to verify OTP');
    mobileSuccess.value = 'Mobile number updated and verified successfully!';
    setTimeout(() => {
      cancelMobileEdit();
      getProfile();
    }, 2000);
  } catch (err) {
    mobileError.value = err.message;
  } finally {
    loadingMobileVerify.value = false;
  }
};

const cancelMobileEdit = () => {
  editingMobile.value = false;
  mobileOtpSent.value = false;
  newMobile.value = '';
  mobileOtp.value = '';
  mobileError.value = '';
  mobileSuccess.value = '';
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
    const token = localStorage.getItem('jwt_token');
    await fetch('/api/v1/logout', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      }
    });
  } catch (err) {
    console.error('Logout failed:', err);
  } finally {
    localStorage.removeItem('jwt_token');
    localStorage.removeItem('user');
    window.location.href = '/';
  }
};

onMounted(() => {
  getProfile();
});
</script>

<style scoped>
:root {
  --primary: #fecc00;
  --primary-ink: #1a1a1a;
  --bg: #f8f9fb;
  --card: #ffffff;
  --ink: #222;
  --muted: #6b7280;
  --border: #e5e7eb;
  --ok: #16a34a;
  --warn: #d97706;
  --error: #dc2626;
}

.page-wrapper { width: 100%; }

.profile-section {
  width: 100%;
  max-width: 100%;
  margin: 24px 0;
  padding: 0 12px;
}

/* Responsive padding to feel "full width" per device */
@media (min-width: 600px) {
  .profile-section { padding: 0 16px; }
}
@media (min-width: 992px) {
  .profile-section { padding: 0 24px; }
}

.profile-card {
  width: 100%;
  background: var(--card);
  padding: 26px;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  border: 1px solid var(--border);
}

@media (min-width: 600px) {
  .profile-card { padding: 28px; }
}
@media (min-width: 992px) {
  .profile-card { padding: 32px; }
}

.card-header {
  display: flex;
  gap: 16px;
  align-items: center;
  margin-bottom: 18px;
}

.avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: #fff7cc;
  display: grid;
  place-items: center;
  color: #c39a00;
  border: 1px solid #ffe78a;
}

.title-wrap h2 { margin: 0; color: var(--ink); font-size: 22px; }
.subtitle { margin: 4px 0 0; color: var(--muted); font-size: 14px; }

.divider { height: 1px; background: var(--border); margin: 22px 0; }

.section { margin-top: 8px; }
.section-head { display:flex; align-items:center; justify-content:space-between; gap: 12px; margin-bottom: 14px; }
.section-head h3 { margin: 0; font-size: 16px; color: var(--ink); display:flex; align-items:center; gap:10px; }

.chips { display:flex; gap:8px; flex-wrap: wrap; }
.chip {
  display:inline-flex; align-items:center; gap:6px;
  padding: 6px 10px; border-radius: 999px; font-size: 12px;
  background:#f3f4f6; color:#374151; border:1px solid var(--border);
}
.chip.ok { background:#e8f7ee; color: var(--ok); border-color: #b6e2c6; }
.chip.warn { background:#fff3d6; color: var(--warn); border-color: #ffe1a3; }
.chip.muted { color:#9ca3af; }

.form-grid { display:grid; grid-template-columns: 1fr; gap:14px; }

.field { display:block; }
.label { display:block; font-size: 13px; color: var(--muted); margin-bottom: 6px; }
.input-wrap { position:relative; }
.input-wrap .icon { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; }
.input-wrap input {
  width: 100%;
  padding: 12px 12px 12px 38px;
  border: 1px solid var(--border);
  border-radius: 8px;
  outline: none;
  transition: box-shadow .2s, border-color .2s;
}
.input-wrap input:focus { border-color: #ffd34d; box-shadow: 0 0 0 4px rgba(254,204,0,0.18); }

.actions { display:flex; gap:10px; flex-wrap: wrap; margin-top: 10px; }

.btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:8px; border:1px solid transparent; cursor:pointer; font-weight:600; font-size:14px; }
.btn:disabled { opacity:.65; cursor:not-allowed; }
.btn-primary { background: var(--primary); color: var(--primary-ink); border-color:#f0c200; }
.btn-primary:hover { background:#ffd84a; }
.btn-secondary { background:#111827; color:#fff; border-color:#0f172a; }
.btn-secondary:hover { background:#0b1223; }
.btn-ghost { background:transparent; color:#374151; border-color: var(--border); }
.btn-ghost:hover { background:#f9fafb; }

.alert { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:14px; margin: 10px 0; border:1px solid; }
.alert-success { background:#eefbea; color:#127a2a; border-color:#c7ecc2; }
.alert-error { background:#fdeeee; color:#8b2020; border-color:#f5c2c2; }

.meta { color: var(--muted); font-size: 13px; margin: 2px 0 4px; }
.current { color: var(--ink); margin: 0 0 10px; }

.notice { padding:10px 12px; border-radius:8px; font-size:13px; margin-bottom:10px; border:1px solid var(--border); background:#f9fafb; color:#374151; }
.notice.ok { background:#e8f7ee; border-color:#b6e2c6; color: var(--ok); }

.fade-enter-active, .fade-leave-active { transition: opacity .2s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

/* Row layout with edit icons */
.row { display:flex; justify-content:space-between; gap:12px; padding:10px 0; align-items:flex-start; }
.row + .row { border-top: 1px dashed var(--border); }
.row-left { flex: 1 1 auto; min-width: 0; }
.row-right { flex: 0 0 auto; display:flex; align-items:center; gap:10px; }
.value { color: var(--ink); word-break: break-word; }
.icon-btn { width:36px; height:36px; display:grid; place-items:center; border-radius:8px; border:1px solid var(--border); background:#fff; color:#374151; cursor:pointer; }
.icon-btn:hover { background:#f9fafb; }
.icon-btn.small { width:28px; height:28px; border-radius:6px; }
.title-wrap { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
.edit-inline { max-width: 520px; }

/* Inline edit group for single-row editing */
.edit-inline-group { display:flex; align-items:center; gap:10px; flex-wrap: nowrap; }
.inline-actions { display:inline-flex; gap:10px; }
.email-row { align-items: center; }
.email-row.editing .row-right { display: none; }
.edit-inline-group .input-wrap { max-width: 360px; }

@media (min-width: 720px) {
  .form-grid { grid-template-columns: 1fr 1fr; }
}
</style>
