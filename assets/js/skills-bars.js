(function () {
  var tracks = document.querySelectorAll('.skill-track');
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var track = entry.target;
        var percent = track.getAttribute('data-percent');
        var fill = track.querySelector('.skill-fill');
        var delay = Array.prototype.indexOf.call(tracks, track) * 90;
        setTimeout(function () {
          fill.style.width = percent + '%';
        }, delay);
        observer.unobserve(track);
      }
    });
  }, { threshold: 0.3 });

  tracks.forEach(function (track) {
    observer.observe(track);
  });
})();

