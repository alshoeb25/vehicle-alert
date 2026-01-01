import './bootstrap';
//import '../css/app.css';
// import '../assets/vendors/bootstrap/css/bootstrap.min.css';
// import '../assets/css/animate.min.css';
// import '../assets/vendors/owl-carousel/owl.carousel.min.css';
// import '../assets/vendors/owl-carousel/owl.theme.default.min.css';
// import '../assets/css/style.css';
// import '../assets/css/responsive.css';

import { createApp } from 'vue';

import LoginForm from './components/LoginForm.vue';
import RegisterForm from './components/RegisterForm.vue';
import ForgotPasswordForm from './components/ForgotPasswordForm.vue';
import ProfileForm from './components/ProfileForm.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import FAQ from './components/FAQ.vue';
import HowItWorks from './components/HowItWorks.vue';
import Shop from './components/Shop.vue';
import Contact from './components/Contact.vue';

const mount = (selector, component) => {
    const el = document.querySelector(selector);
    if (el) {
        const app = createApp(component);
        app.mount(el);
    }
};

mount('#login-form-root', LoginForm);
mount('#register-form-root', RegisterForm);
mount('#forgot-password-root', ForgotPasswordForm);
mount('#profile-root', ProfileForm);
mount('#home-root', Home);
mount('#about-root', About);
mount('#faq-root', FAQ);
mount('#how-it-works-root', HowItWorks);
mount('#shop-root', Shop);
mount('#contact-root', Contact);
