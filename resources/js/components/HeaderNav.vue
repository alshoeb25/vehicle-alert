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
                @click.stop="$event.stopPropagation()"
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
    !profileDropdown.value.contains(e.target) &&
    dropdownOpen.value
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
/* Base Styles */
* {
  box-sizing: border-box;
}

/* Responsive header container */
.main-header { 
  width: 100%; 
  max-width: 100vw;
  padding: 0;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  background: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  overflow: visible;
  overflow-x: hidden;
  border-bottom: 1px solid #eee;
}

.main-menu { 
  width: 100%; 
  max-width: 100%;
  padding: 0;
  margin: 0;
  overflow: visible;
  overflow-x: hidden;
}

.main-menu .container { 
  width: 100%; 
  max-width: 1400px;
  margin: 0 auto;
  padding: 0.75rem 1rem;
}

.main-menu-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  gap: 1rem;
  max-width: 100%;
  overflow-x: hidden;
}

.main-menu-wrapper__left {
  flex-shrink: 0;
  max-width: 50%;
  overflow: hidden;
}

.main-menu-wrapper__logo a {
  display: block;
  line-height: 0;
  max-width: 100%;
}

.main-menu-wrapper__logo img {
  width: auto;
  max-width: 100%;
  object-fit: contain;
}

.main-menu-wrapper__right {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex: 1;
  justify-content: flex-end;
  min-width: 0;
  flex-shrink: 1;
  position: relative;
  z-index: 999;
}

.main-menu-wrapper__main-menu {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.mobile-nav__toggler {
  display: none;
  padding: 0.5rem;
  font-size: 1.5rem;
  color: inherit;
  background: none;
  border: none;
  cursor: pointer;
  transition: color 0.3s ease;
}

.mobile-nav__toggler:hover {
  color: #fecc00;
}

.main-menu__list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 1.5rem;
  align-items: center;
}

.main-menu__list li {
  margin: 0;
}

.main-menu__list a {
  color: inherit;
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 500;
  padding: 0.5rem 0;
  transition: color 0.3s ease;
  white-space: nowrap;
}

.main-menu__list a:hover {
  color: #fecc00;
}

.main-menu__list a.active {
  color: #fecc00;
  font-weight: 600;
}

.main-header__btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1.2rem;
  background: #fecc00;
  color: #000;
  border: none;
  border-radius: 4px;
  font-size: 0.9rem;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.main-header__btn:hover {
  background: #e6b800;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Profile Dropdown */
.profile-dropdown {
  position: relative;
  display: inline-block;
}

.profile-btn {
  position: relative;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #fecc00;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  color: #000;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.profile-btn:hover {
  background: #e6b800;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.profile-btn span {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
}

.verified-badge { 
  color: #28a745; 
  font-size: 14px; 
  display: inline-flex;
  align-items: center;
}

.unverified-badge { 
  color: #dc3545; 
  font-size: 14px; 
  animation: pulse 2s infinite;
  display: inline-flex;
  align-items: center;
}

@keyframes pulse { 
  0%, 100% { opacity: 1; } 
  50% { opacity: 0.5; } 
}

.dropdown-menu {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  min-width: 280px;
  z-index: 10001;
  display: block !important;
  animation: slideDown 0.3s ease-out;
  max-height: 80vh;
  overflow-y: auto;
  overflow-x: hidden;
}

@keyframes slideDown {
  from { 
    opacity: 0; 
    transform: translateY(-10px); 
  }
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

.dropdown-header { 
  padding: 1rem; 
  border-bottom: 1px solid #f0f0f0; 
}

.user-name { 
  margin: 0; 
  font-weight: 600; 
  color: #333; 
  font-size: 1rem; 
  word-break: break-word;
}

.user-email { 
  margin: 0.25rem 0 0 0; 
  color: #666; 
  font-size: 0.85rem; 
  overflow: hidden; 
  text-overflow: ellipsis; 
  white-space: nowrap; 
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  padding: 0.35rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
  margin-top: 0.5rem;
}

.status-badge.verified { 
  background: #d4edda; 
  color: #155724; 
}

.status-badge.unverified { 
  background: #fff3cd; 
  color: #856404; 
}

.dropdown-divider { 
  height: 1px; 
  background: #f0f0f0; 
  margin: 0.5rem 0; 
}

.dropdown-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  width: 100%;
  padding: 0.75rem 1rem;
  background: none;
  border: none;
  text-align: left;
  cursor: pointer;
  color: #333;
  font-size: 0.9rem;
  transition: all 0.2s ease;
  text-decoration: none;
}

.dropdown-item:hover { 
  background: #f8f9fa; 
  color: #fecc00; 
}

.dropdown-item.active { 
  background: #fff8dc; 
  color: #fecc00; 
  font-weight: 500; 
}

.dropdown-item i { 
  min-width: 18px; 
  text-align: center; 
  font-size: 1rem;
}

.logout-btn { 
  color: #dc3545; 
}

.logout-btn:hover { 
  background: #ffe8e8; 
  color: #c82333; 
}

/* Ensure wrappers don't clip the dropdown */
.main-menu-wrapper,
.main-menu-wrapper__right,
.main-menu,
.main-header {
  overflow: visible;
  position: relative;
}

.profile-dropdown { 
  z-index: 10001; 
}

/* Tablet Styles (768px to 991px) */
@media (max-width: 991px) {
  .mobile-nav__toggler {
    display: block;
  }

  .main-menu__list {
    display: none;
  }

  .main-menu-wrapper__left {
    width: 40%;
  }

  .main-menu-wrapper__right {
    gap: 0.75rem;
  }

  .main-header__btn,
  .profile-btn {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
  }

  .profile-dropdown {
  position: relative;
  z-index: 999;
  }

  .dropdown-menu {
    right: 0;
    left: auto;
    min-width: 260px;
    max-width: calc(100vw - 2rem);
    position: absolute;
  }
}

/* Mobile Styles (up to 767px) */
@media (max-width: 767px) {
  .main-menu .container {
    padding: 0.5rem 0.5rem;
  }

  .main-menu-wrapper {
    gap: 0.5rem;
    flex-wrap: nowrap;
  }

  .main-menu-wrapper__left {
    width: auto;
    max-width: 50%;
    flex-shrink: 1;
  }

  .main-menu-wrapper__logo img {
    max-width: 100%;
  }

  .main-header__btn,
  .profile-btn {
    padding: 0.4rem 0.7rem;
    font-size: 0.75rem;
    gap: 0.3rem;
    flex-shrink: 0;
  }

  .profile-btn span:not(.verified-badge):not(.unverified-badge) {
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .profile-dropdown {
    position: relative;
    z-index: 999;
  }

  .dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    left: auto;
    min-width: 240px;
    max-width: calc(100vw - 16px);
    max-height: 65vh;
    overflow-y: auto;
    z-index: 10001;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .dropdown-header {
    padding: 0.85rem;
  }


  .user-name {
    font-size: 0.95rem;
  }

  .user-email {
    font-size: 0.8rem;
  }

  .dropdown-item {
    padding: 0.65rem 0.85rem;
    font-size: 0.85rem;
  }

  .verified-badge,
  .unverified-badge {
    font-size: 12px;
  }
}

/* Extra Small Mobile (up to 480px) */
@media (max-width: 480px) {
  .main-menu .container {
    padding: 0.4rem 0.4rem;
  }

  .main-menu-wrapper {
    gap: 0.35rem;
  }

  .main-menu-wrapper__left {
    max-width: 45%;
  }

  .main-menu-wrapper__logo img {
    max-width: 100%;
  }

  .main-header__btn,
  .profile-btn {
    padding: 0.35rem 0.6rem;
    font-size: 0.7rem;
    gap: 0.25rem;
  }

  .main-header__btn i,
  .profile-btn i {
    font-size: 0.85rem;
  }

  .profile-btn span:not(.verified-badge):not(.unverified-badge) {
    display: none;
  }

  .mobile-nav__toggler {
    padding: 0.35rem;
    font-size: 1.25rem;
  }

  .profile-dropdown {
    position: relative;
    z-index: 999;
  }

  .dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    left: auto;
    min-width: 220px;
    max-width: calc(100vw - 12px);
    max-height: 60vh;
    overflow-y: auto;
    z-index: 10001;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
}

/* Desktop Styles (992px and up) */
@media (min-width: 992px) {
  .main-menu .container {
    padding: 1rem 2rem;
  }

  .main-menu__list {
    display: flex;
    gap: 2rem;
  }

  .mobile-nav__toggler {
    display: none;
  }
}

/* Large Desktop (1400px and up) */
@media (min-width: 1400px) {
  .main-menu .container {
    padding: 1.25rem 3rem;
  }

  .main-menu__list {
    gap: 2.5rem;
  }

  .main-menu__list a {
    font-size: 1rem;
  }
}
</style>
