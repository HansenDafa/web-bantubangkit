// Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
// Ketika Hamburger Menu di click
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// Klik di Luar Sidebar untuk Menghilangkan NavBar
const hamburger = document.querySelector("#hamburger-menu");
document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

//Untuk submit form admin page
function submitForm() {
  document.getElementById("myForm").submit();
}

// Function to format number into Indonesian Rupiah format
function formatRupiah(angka) {
  var reverse = angka.toString().split('').reverse().join('');
  var ribuan = reverse.match(/\d{1,3}/g);
  var formatted = ribuan.join('.').split('').reverse().join('');
  return 'Rp' + formatted;
}

// Function to handle input event
function handleInput() {
  var nominalInput = document.getElementById('nominal_pembayaran');
  var nominalValue = nominalInput.value.replace(/\D/g, '');
  nominalInput.value = formatRupiah(nominalValue);
}

// Add event listener to the input field
document.getElementById('nominal_pembayaran').addEventListener('input', handleInput);


function delay(n) {
  n = n || 2000;
  return new Promise((done) => {
      setTimeout(() => {
          done();
      }, n);
  });
}

function pageTransition() {
  var tl = gsap.timeline();
  tl.to(".loading-screen", {
      duration: 1.2,
      width: "100%",
      left: "0%",
      ease: "Expo.easeInOut",
  });

  tl.to(".loading-screen", {
      duration: 1,
      width: "100%",
      left: "100%",
      ease: "Expo.easeInOut",
      delay: 0.3,
  });
  tl.set(".loading-screen", { left: "-100%" });
}

function contentAnimation() {
  var tl = gsap.timeline();
  tl.from(".animate-this", { duration: 1, y: 30, opacity: 0, stagger: 0.4, delay: 0.2 });
}

$(function () {
  barba.init({
      sync: true,

      transitions: [
          {
              async leave(data) {
                  const done = this.async();

                  pageTransition();
                  await delay(1000);
                  done();
              },

              async enter(data) {
                  contentAnimation();
              },

              async once(data) {
                  contentAnimation();
              },
          },
      ],
  });
});