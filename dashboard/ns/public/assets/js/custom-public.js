$(document).ready(function () {
  // Function to toggle password visibility
  function togglePasswordVisibility(containerId) {
    $(containerId + " a").on("click", function (event) {
      event.preventDefault();

      // Check if input type is 'text' or 'password'
      if ($(containerId + " input").attr("type") == "text") {
        // Change input to 'password'
        $(containerId + " input").attr("type", "password");

        // Update the class of the span and change text to 'Show'
        $(containerId + " span.password-show-hide")
          .addClass("passwordhide")
          .removeClass("passwordshow")
          .text("Show");
      } else if ($(containerId + " input").attr("type") == "password") {
        // Change input to 'text'
        $(containerId + " input").attr("type", "text");

        // Update the class of the span and change text to 'Hide'
        $(containerId + " span.password-show-hide")
          .removeClass("passwordhide")
          .addClass("passwordshow")
          .text("Hide");
      }
    });
  }

  togglePasswordVisibility("#show_hide_password");
  togglePasswordVisibility("#show_hide_password2");
  togglePasswordVisibility("#show_hide_password0");

// Handle paste event for the OTP input fields
$(".verification-code-wrapper").on("paste", function (event) {
  event.preventDefault();

  // Get pasted data and limit it to the first 6 characters
  const pasteData = event.originalEvent.clipboardData
      .getData("text")
      .slice(0, 6);

  // Distribute each character into the respective input
  for (let i = 0; i < pasteData.length; i++) {
      $(`#verification_code${i + 1}`).val(pasteData[i]);
  }

  // Update the hidden input field with the pasted code
  $("#otp").val(pasteData);
});

// Move focus to the next input when a character is entered
$(".verification-code-wrapper input").on("input", function () {
  const $this = $(this);

  // If input has one character, move to the next input field
  if ($this.val().length === 1) {
      $this.next("input").focus();
  }

  // Collect all input values and update the hidden field
  const otpValue = $(".verification-code-wrapper input")
      .map(function () {
          return $(this).val();
      })
      .get()
      .join("");
  $("#otp").val(otpValue);
});

// Handle keyboard navigation (e.g., backspace to move to the previous field)
$(".verification-code-wrapper input").on("keydown", function (e) {
  const $this = $(this);

  if (e.key === "Backspace" && $this.val() === "") {
      $this.prev("input").focus();
  }
});
});

document.querySelectorAll(".navbar li").forEach((item) => {
  item.addEventListener("mouseenter", () => {
    const prev = item.previousElementSibling;
    if (prev) {
      prev.classList.add("no-border");
    }
  });

  item.addEventListener("mouseleave", () => {
    const prev = item.previousElementSibling;
    if (prev) {
      prev.classList.remove("no-border");
    }
  });

  // Tabs accordion

  $(".tab_content").hide();
  $(".tab_content:first").show();

  /* if in tab mode */
  $("ul.dzn_tabs li").click(function () {
    $(".tab_content").hide();
    var activeTab = $(this).attr("rel");
    $("#" + activeTab).fadeIn();

    $("ul.dzn_tabs li").removeClass("active");
    $(this).addClass("active");

    $(".tab_drawer_heading").removeClass("d_active");
    $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
  });
  $(".tab_container").css("min-height", function () {
    return $(".tabs").outerHeight() + 50;
  });
  /* if in drawer mode */
  $(".tab_drawer_heading").click(function () {
    $(".tab_content").hide();
    var d_activeTab = $(this).attr("rel");
    $("#" + d_activeTab).fadeIn();

    $(".tab_drawer_heading").removeClass("d_active");
    $(this).addClass("d_active");

    $("ul.dzn_tabs li").removeClass("active");
    $("ul.dzn_tabs li[rel^='" + d_activeTab + "']").addClass("active");
  });
});

// swiper marquee
var swiper = new Swiper(".mySwiperMarquee", {
  spaceBetween: 0,
  centeredSlides: true,
  speed: 15000,
  autoplay: {
    delay: 0,
    disableOnInteraction: false, // Ensure autoplay resumes after interaction
  },
  loop: true,
  slidesPerView: 3,
  allowTouchMove: false,
});

// Pause autoplay on mouse hover
const swiperContainer = document.querySelector(
  ".mySwiperMarquee .swiper-wrapper"
);

// Ensure the correct element is targeted
if (swiperContainer) {
  swiperContainer.addEventListener("mouseenter", () => {
    swiper.autoplay.stop();
  });

  swiperContainer.addEventListener("mouseleave", () => {
    swiper.autoplay.start();
  });
}

var menu = ["", "", ""];
var mySwiper = new Swiper(".swiper-testimonial", {
  slidesPerView: 1,
  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + menu[index] + "</span>";
    },
  },
});
var swiper = new Swiper(".SwiperSubscription", {
  autoplay: {
    delay: 5000,
  },
  slidesPerView: 5,
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0
    },
    
    // when window width is >= 640px
    640: {
      slidesPerView: 1,
      spaceBetween: 0
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 0
    },
    1200: {
      slidesPerView: 5,
    }
  }

});