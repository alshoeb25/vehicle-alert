<template>
    <div class="page-wrapper">
        <HeaderNav :is-logged-in="isLoggedIn" @toggle-mobile="toggleMobileNav" @logout="logout" />
        <section class="page-header">
            <div class="page-header__bg" style="background: #fecc00;">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-header__wrapper">
                            <div class="page-header__content">
                                <h2>FAQ'S</h2>
                                <div class="page-header__menu">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li>FAQ'S</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        <div class="container pt-100 z-index-1">
            <div class="row">
                <div class="col">
                    <div class="tab bg-white box-shadow">
                        <!-- Nav tabs -->
                        <nav>
                            <div class="nav nav-tabs border-0 text-center box-shadow" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-tab1" data-bs-toggle="tab" href="#tab1-1" role="tab" aria-selected="false">
                                    <div class="tab-icon">
                                        <i class="fa-solid fa-gear" style="font-size: 27px;padding-top: 7px;color: #000;"></i>
                                    </div>
                                    <h5>Getting Started</h5>
                                </a> <a class="nav-item nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab1-2" role="tab" aria-selected="false">
                                    <div class="tab-icon">
                                        <i class="fa-solid fa-user" style="font-size: 27px;padding-top: 7px;color: #000;"></i>
                                    </div>
                                    <h5>My Account</h5>
                                </a>
                                <a class="nav-item nav-link" id="nav-tab3" data-bs-toggle="tab" href="#tab1-3" role="tab" aria-selected="false">
                                    <div class="tab-icon">
                                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 27px;padding-top: 7px;color: #000;"></i>
                                    </div>
                                    <h5>Error Messages</h5>
                                </a>
                                <a class="nav-item nav-link " id="nav-tab4" data-bs-toggle="tab" href="#tab1-4" role="tab" aria-selected="true">
                                    <div class="tab-icon">
                                        <i class="fa-regular fa-clipboard" style="font-size: 27px;padding-top: 7px;color: #000;"></i>
                                         
                                    </div>
                                    <h5>Vehicle Registration</h5>
                                </a>
                            </div>
                        </nav>
        
                        <!-- Tab panes -->
                        <div class="tab-content px-5 py-8" id="nav-tabContent">
                            <div role="tabpanel" class="tab-pane fade  active show" id="tab1-1">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-12" >
                                        <img class="img-fluid" src="assets/images/getting-started-1.svg" alt="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                        <h4 class="mb-4">Getting Started  </h4>
                                        <p class="mb-4">Here you’ll find information about Getting Started.  </p>
                                       
                                       <div>
                                        <span class="head-titile-faq">For Apple mobile </span> 
                                        <div class="d-flex  mt-1 mb-2">
                                            <div class="me-2"> <span class="list-dot">1</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Click on the App Store Icon</p>
                                            </div>
                                        </div>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">2</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Click on the Search icon</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">3</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Type <span class="faq-subtitle">Vehicle Alerts</span> to download</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Go back to your mobile Dashboard and start using it.                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="head-titile-faq">For Android mobile  </span> 
                                        <div class="d-flex  mt-1 mb-2">
                                            <div class="me-2"> <span class="list-dot">1</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Click on the Google Play Store icon.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">2</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Click on the Search icon</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">3</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Type <span class="faq-subtitle">Vehicle Alerts</span> to download</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Go back to your mobile Dashboard and start using it.                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <div class="ribbon">
                                    <div class="faq-help">
                                        <img src="assets/images/mail-faq.png" alt="" style="width: 3%;">  Didn't find an answer to your question, we are here to help 
                                        <span>
                                            <a href="contact.html" class="contact-btn2" >
                                            <img src="assets/images/contact.png" alt="" style="width: 2%;"> 
                                            <span> Contact Us</span>
                                         </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab1-2">
                               
                                <div class="row ">
                                    <div class="col-lg-6 col-md-12" >
                                        <img class="img-fluid" src="assets/images/my-account.png" alt="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                        <h4 class="mb-4">My Account </h4>
                                        <p class="mb-4">Here you’ll find information about <span class="faq-subtitle">My Account</span> </p>
                                       
                                       <div>
                                        <span class="head-titile-faq">Reset Password </span> 
                                        <p>If you want to reset your password.</p>
                                        <div class="d-flex  mt-1 mb-2">
                                            <div class="me-2"> <span class="list-dot">1</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Go to MY ACCOUNT under the app menu</p>
                                            </div>
                                        </div>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">2</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Tap the PASSWORD field</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">3</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Type In the RESET PASSWORD screen enter your current password and the new password.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Tap Save and your password will be updated.                                          </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="head-titile-faq">Change Mobile Number </span> 
                                        <p>Go to MY ACCOUNT under the app menu.</p>
                                        <div class="d-flex  mt-1 mb-2">
                                            <div class="me-2"> <span class="list-dot">1</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Tap the MOBILE NUMBER field to enter your new number and click to Save.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">2</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">You will receive the OTP on your new mobile number. You will be asked to verify the One Time.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">3</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Type Password (OTP) to update your new mobile number in the system.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Go back to your mobile Dashboard and start using it.                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <div class="ribbon">
                                    <div class="faq-help">
                                        <img src="assets/images/mail-faq.png" alt="" style="width: 3%;">  Didn't find an answer to your question, we are here to help 
                                        <span>
                                            <a href="contact.html" class="contact-btn2" >
                                            <img src="assets/images/contact.png" alt="" style="width: 2%;"> 
                                            <span> Contact Us</span>
                                         </a>
                                        </span>
                                    </div>
                                </div>

                               
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab1-3">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-12" >
                                        <img class="img-fluid" src="assets/images/error.jpeg" alt="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                        <h4 class="mb-4">Error Messages</h4>
                                        <p class="mb-4">Here you’ll find information about <span class="faq-subtitle">Error Messages</span> </p>
                                       <span class="head-titile-faq">Mobile number already existing </span>
                                       <p>During the new registration, if you are receiving an error message “Mobile number already existing” 
                                        it could be because there is an existing account with this mobile number. You can sign in with a new 
                                        number and proceed with Forgot Password. option. </p>
                                        <span class="head-titile-faq">My Account is Blocked </span>
                                       <p>Every individual has the right to feel safe and free from harassment. It may be because you 
                                        send the wrong notifications to other vehicle contacts. People who violate the VA's guidelines 
                                        may receive a warning or might get temporarily blocked for 24 hours.
                                        (As per discussion, if the alternate number also does not respond, the case will be transferred to 
                                        Traffic Police) </p>
                                        <span class="head-titile-faq">What makes a QR code unscannable? </span>
                                        <p>If your camera not scanning the QR code, chances are, you're either trying to scan it in poor 
                                            lighting or are either too close to the code or not close enough. You need to ensure you're at 
                                            an appropriate distance from the QR code and have sufficient light. You can even ask 
                                            someone to hold up a flashlight while you scan </p>

 
                                    </div>
                                </div>
                                <div class="ribbon">
                                    <div class="faq-help">
                                        <img src="assets/images/mail-faq.png" alt="" style="width: 3%;">  Didn't find an answer to your question, we are here to help 
                                        <span>
                                            <a href="contact.html" class="contact-btn2" >
                                            <img src="assets/images/contact.png" alt="" style="width: 2%;"> 
                                            <span> Contact Us</span>
                                         </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab1-4">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-12"  >
                                        <img class="img-fluid" src="assets/images/my-account.jpeg" alt="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                        <h4 class="mb-4">Vehicle Registration   </h4>
                                        <p class="mb-4">Here you’ll find information about <span class="faq-subtitle">Vehicle Registration</span>.
                                        </p>
                                       <span class="head-titile-faq">Vehicle already registered</span>
                                       <p>If you get this error message, it means the VA tag is already registered with some vehicle. Please submit a 
                                        copy of your ID and Vehicle Registration ID to <span>wecare@ayzanlabs.com</span> to update your mobile number to 
                                        re-activate the VA QR Tag. The administrative charges of Rs 100/- shall be applied.
                                        </p>
                                        <p class="mb-4">How many types of Notifications I can SEND ?</p>
                                        <span>You can SEND notifications for the following reasons after scanning the QR Code of the parked vehicle   </span>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">1</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Wrong Parking / Vehicle Blocking</p>
                                            </div>
                                        </div>
                                        <div class="d-flex  mb-2">
                                            <div class="me-2"> <span class="list-dot">2</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Left Car Lights On</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">3</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Left Baby in Car</p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Parked Within A Tow-Away Zone.                                               </p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">5</span>
                                            </div>
                                            <div>
                                                <p class="mb-0">Road Accident  </p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">6</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Left Doors / Windows Open                                               </p>
                                            </div>
                                        </div>
                                        <div class="d-flex   mb-2">
                                            <div class="me-2"> <span class="list-dot">4</span>
                                            </div>
                                            <div>
                                                <p class="mb-0"> Threat to vehicle           </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ribbon">
                                    <div class="faq-help">
                                        <img src="assets/images/mail-faq.png" alt="" style="width: 3%;">  Didn't find an answer to your question, we are here to help 
                                        <span>
                                            <a href="contact.html" class="contact-btn2" >
                                            <img src="assets/images/contact.png" alt="" style="width: 2%;"> 
                                            <span> Contact Us</span>
                                         </a>
                                        </span>
                                    </div>
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
      current-page="faq"
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
.mobile-nav__wrapper.expanded {
  visibility: visible;
}
.chatbot.show {
  transform: translateY(0);
  opacity: 1;
}
</style>