<template>
  <header class="main-header clearfix">
    <nav class="main-menu clearfix">
      <div class="container clearfix">
        <div class="main-menu-wrapper clearfix">

          <!-- LOGO -->
          <div class="main-menu-wrapper__left">
            <div class="main-menu-wrapper__logo">
              <a href="/">
                <img src="/assets/images/logo.png" alt="Respo QR Codes" />
              </a>
            </div>
          </div>

          <!-- MENU -->
          <div class="main-menu-wrapper__right">
            <div class="main-menu-wrapper__main-menu">
              <a
                href="#"
                class="mobile-nav__toggler"
                @click.prevent="$emit('toggle-mobile')"
              >
                <i class="fa fa-bars"></i>
              </a>

              <ul class="main-menu__list">
                <li><a href="/" :class="{ active: isActive('/') }">Home</a></li>
                <li><a href="/about" :class="{ active: isActive('/about') }">About Us</a></li>
                <li><a href="/shop" :class="{ active: isActive('/shop') }">Shop</a></li>
                <li><a href="/how-it-works" :class="{ active: isActive('/how-it-works') }">How It Works</a></li>
                <li><a href="/contact" :class="{ active: isActive('/contact') }">Contact</a></li>
                <li><a href="/faq" :class="{ active: isActive('/faq') }">FAQ'S</a></li>
              </ul>
            </div>

            <!-- LOGIN -->
            <a
              v-if="!isAuthenticated"
              href="/login"
              class="main-header__btn"
            >
              <i class="fa-solid fa-user"></i> LOGIN
            </a>

            <!-- PROFILE DROPDOWN -->
            <div
              v-else
              ref="profileDropdown"
              class="profile-dropdown"
            >
              <button
                class="main-header__btn profile-btn"
                @click.stop="toggleDropdown"
              >
                <i class="fa-solid fa-user"></i>
                {{ userData.name || 'Profile' }}

                <span v-if="userVerified" class="verified-badge">
                  <i class="fa-solid fa-circle-check"></i>
                </span>
                <span v-else class="unverified-badge">
                  <i class="fa-solid fa-exclamation-circle"></i>
                </span>

                <i
                  class="fa-solid"
                  :class="dropdownOpen ? 'fa-chevron-up' : 'fa-chevron-down'"
                ></i>
              </button>

              <!-- DROPDOWN MENU -->
              <div
                v-if="dropdownOpen"
                class="dropdown-menu"
                @click.stop
              >
                <div class="dropdown-header">
                  <p class="user-name">{{ userData.name }}</p>
                  <p class="user-email">
                    {{ userData.email || userData.mobile }}
                  </p>

                  <span
                    class="status-badge"
                    :class="userVerified ? 'verified' : 'unverified'"
                  >
                    <i
                      class="fa-solid"
                      :class="userVerified
                        ? 'fa-circle-check'
                        : 'fa-exclamation-circle'"
                    ></i>
                    {{ userVerified ? 'Verified' : 'Not Verified' }}
                  </span>
                </div>

                <div class="dropdown-divider"></div>

                <a
                  href="/profile"
                  class="dropdown-item"
                  :class="{ active: isActive('/profile') }"
                  @click="closeDropdown"
                >
                  <i class="fa-solid fa-user-circle"></i> My Profile
                </a>

                <a
                  href="/profile"
                  class="dropdown-item"
                  :class="{ active: isActive('/profile') }"
                  @click="closeDropdown"
                >
                  <i class="fa-solid fa-cog"></i> Settings
                </a>

                <div class="dropdown-divider"></div>

                <button
                  class="dropdown-item logout-btn"
                  @click="handleLogout"
                >
                  <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const dropdownOpen = ref(false);
const profileDropdown = ref(null);
const isMounted = ref(false);

/* AUTH */
const isAuthenticated = computed(() => {
  if (!isMounted.value) return false;
  return !!localStorage.getItem('jwt_token');
});

/* USER */
const userData = computed(() => {
  try {
    return JSON.parse(localStorage.getItem('user')) || {};
  } catch {
    return {};
  }
});

const userVerified = computed(() => userData.value.is_verified === true);

/* ACTIVE PAGE DETECTION */
const isActive = (path) => {
  const currentPath = window.location.pathname;
  if (path === '/') {
    return currentPath === '/';
  }
  return currentPath.startsWith(path);
};

/* DROPDOWN */
const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
};

const closeDropdown = () => {
  dropdownOpen.value = false;
};

/* OUTSIDE CLICK */
const handleOutsideClick = (e) => {
  if (
    profileDropdown.value &&
    !profileDropdown.value.contains(e.target)
  ) {
    closeDropdown();
  }
};

/* LOGOUT */
const handleLogout = async () => {
  try {
    const token = localStorage.getItem('jwt_token');
    await fetch('/api/v1/logout', {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token}`,
        'X-CSRF-TOKEN':
          document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    });
  } catch (e) {
    console.error(e);
  } finally {
    localStorage.removeItem('jwt_token');
    localStorage.removeItem('user');
    window.location.href = '/';
  }
};

onMounted(() => {
  isMounted.value = true;
  document.addEventListener('click', handleOutsideClick);
});

onUnmounted(() => {
  document.removeEventListener('click', handleOutsideClick);
});
</script>

<style scoped>
/* Responsive header container */
.main-header { width: 100%; }
.main-menu .container { width: 100%; padding-left: 16px; padding-right: 16px; }

.profile-dropdown {
  position: relative;
  display: inline-block;
}

.profile-btn {
  position: relative;
  display: flex;
  align-items: center;
  gap: 8px;
  background: none;
  border: none;
  padding: 10px 15px;
  cursor: pointer;
  font-size: 14px;
  color: inherit;
  transition: all 0.3s ease;
}

.profile-btn:hover {
  color: #fecc00;
}

.profile-btn span {
  display: flex;
  align-items: center;
  gap: 8px;
  white-space: nowrap;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  min-width: 280px;
  margin-top: 8px;
  z-index: 10000;
  display: block; /* override bootstrap default hidden */
  animation: slideDown 0.3s ease-out;
}

/* Stronger override for Bootstrap dropdown */
.profile-dropdown .dropdown-menu { display: block !important; }

@keyframes slideDown {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.dropdown-header { padding: 16px; border-bottom: 1px solid #f0f0f0; }
.user-name { margin: 0; font-weight: 600; color: #333; font-size: 16px; }
.user-email { margin: 4px 0 0 0; color: #666; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.verification-status { margin-top: 8px; }

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}
.status-badge.verified { background: #d4edda; color: #155724; }
.status-badge.unverified { background: #fff3cd; color: #856404; }

.dropdown-divider { height: 1px; background: #f0f0f0; margin: 8px 0; }
.dropdown-item {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 12px 16px;
  background: none;
  border: none;
  text-align: left;
  cursor: pointer;
  color: #333;
  font-size: 14px;
  transition: all 0.2s ease;
  text-decoration: none;
}
.dropdown-item:hover { background: #f8f9fa; color: #fecc00; }
.dropdown-item.active { background: #fff8dc; color: #fecc00; font-weight: 500; }
.dropdown-item i { min-width: 18px; text-align: center; }

.logout-btn { color: #dc3545; }
.logout-btn:hover { background: #ffe8e8; color: #c82333; }

.verified-badge { color: #28a745; margin-left: 5px; font-size: 14px; }
.unverified-badge { color: #ffc107; margin-left: 5px; font-size: 14px; animation: pulse 2s infinite; }
@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }

/* Ensure wrappers don't clip the dropdown */
.main-menu-wrapper,
.main-menu-wrapper__right {
  overflow: visible;
  position: relative;
}

.main-menu, .main-header, .stricky-header, .stricky-header .main-menu {
  overflow: visible;
  position: relative;
}

.profile-dropdown { z-index: 10001; }

/* Make profile visible on mobile */
@media (max-width: 991px) {
  .main-menu__list { display: none; }
  .main-menu-wrapper__right {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .main-header__btn {
    display: inline-flex !important;
    align-items: center;
  }
  .profile-dropdown { display: inline-flex; }
  .dropdown-menu { right: 0; left: auto; min-width: 240px; }
}

/* Show desktop nav */
@media (min-width: 992px) {
  .main-menu__list { display: flex; align-items: center; gap: 14px; }
  .main-menu__list a { color: inherit; text-decoration: none; transition: color 0.3s ease; }
  .main-menu__list a:hover { color: #fecc00; }
  .main-menu__list a.active { color: #fecc00; font-weight: 600; }
}
</style>
