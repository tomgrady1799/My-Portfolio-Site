document.addEventListener('DOMContentLoaded', function () {
  var heroText = document.querySelector('.hero-text-col');
  var table = document.querySelector('.personal-details-table');
  var homeImages = document.querySelectorAll('.hero-image-col');

  if (heroText) {
    setTimeout(function () {
      heroText.classList.add('is-visible');
    }, 500);
  }

  if (table) {
    setTimeout(function () {
      table.classList.add('is-visible');
    }, 700);
  }

  if (homeImages.length) {
    setTimeout(function () {
      homeImages.forEach(function (el) {
        el.classList.add('is-visible');
      });
    }, 700);
  }
});

