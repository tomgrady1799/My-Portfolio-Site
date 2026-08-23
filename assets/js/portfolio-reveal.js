(function () {
  var cards = document.querySelectorAll(
    '.wp-block-post-template > li, .wp-block-post-template > .wp-block-post'
  );
  if (!cards.length) return;

  cards.forEach(function (card) {
    card.style.opacity = '0';
    card.style.transform = 'translateY(24px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
  });

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var index = Array.prototype.indexOf.call(cards, entry.target);
          setTimeout(function () {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, index * 120);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.01, rootMargin: '0px 0px 600px 0px' }
  );

  cards.forEach(function (card) {
    observer.observe(card);
  });
})();