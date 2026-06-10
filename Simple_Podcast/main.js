(() => {
  const isHomePage = !!document.querySelector('.hero-home');
  
  const episodes = [
    {
      id: 1,
      title: "Building Modern Web Portfolios",
      category: "Tech",
      date: "Oct 12, 2023",
      desc: "In this episode, we explore the essentials of creating a standout web development portfolio.",
      imageUrl: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800",
      audioUrl: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3", // Example track
      tags: ["webdev", "careers"]
    },
    {
      id: 2,
      title: "The Minimalist Mindset",
      category: "Life",
      date: "Oct 05, 2023",
      desc: "How simplifying your digital and physical space can lead to greater focus and productivity.",
      imageUrl: "https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?auto=format&fit=crop&q=80&w=800",
      audioUrl: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3",
      tags: ["minimalism", "productivity"]
    },
    {
      id: 3,
      title: "Scaling Your First App",
      category: "Tech",
      date: "Sep 28, 2023",
      desc: "Going from 1 to 1,000 users. What architectural changes do you actually need?",
      imageUrl: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800",
      audioUrl: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3",
      tags: ["backend", "scaling"]
    }
  ];

  // State
  let currentEpisodeIndex = -1;
  let isPlaying = false;
  const audio = new Audio();

  // DOM Elements
  const grid = document.getElementById('episodes');
  const template = document.getElementById('episodeTemplate');
  const searchInput = document.getElementById('episodeSearch');
  const filterBtns = document.querySelectorAll('.filter-btn');
  
  // Player Elements
  const playPauseBtn = document.getElementById('playPauseBtn');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const progressBar = document.getElementById('progressBar');
  const volumeBar = document.getElementById('volumeBar');
  const currentTimeEl = document.getElementById('currentTime');
  const durationTimeEl = document.getElementById('durationTime');
  const trackTitle = document.getElementById('currentTrackTitle');
  const trackCategory = document.getElementById('currentTrackCategory');

  // Initial Year
  document.getElementById('year').textContent = new Date().getFullYear();

  const formatTime = (seconds) => {
    if (isNaN(seconds)) return "0:00";
    const min = Math.floor(seconds / 60);
    const sec = Math.floor(seconds % 60);
    return `${min}:${sec < 10 ? '0' : ''}${sec}`;
  };

  const renderEpisodes = (list) => {
    grid.innerHTML = '';
    list.forEach((ep, index) => {
      const clone = template.content.cloneNode(true);
      const card = clone.querySelector('.episode-card');
      card.style.animation = `fadeInUp 0.6s ease-out forwards ${index * 0.1}s`;
      
      clone.querySelector('.episode-image img').src = ep.imageUrl;
      clone.querySelector('.tag').textContent = ep.category;
      clone.querySelector('.date').textContent = ep.date;
      clone.querySelector('.episode-title').textContent = ep.title;
      clone.querySelector('.episode-desc').textContent = ep.desc;
      
      const playBtn = clone.querySelector('[data-action="play"]');
      playBtn.addEventListener('click', () => playEpisode(episodes.indexOf(ep)));
      
      grid.appendChild(clone);
    });
  };

  const playEpisode = (index) => {
    if (index < 0 || index >= episodes.length) return;
    
    const ep = episodes[index];
    if (currentEpisodeIndex !== index) {
      currentEpisodeIndex = index;
      audio.src = ep.audioUrl;
      trackTitle.textContent = ep.title;
      trackCategory.textContent = ep.category;
      audio.load();
    }

    if (isPlaying) {
      audio.pause();
    } else {
      audio.play();
    }
  };

  // Audio Event Listeners
  audio.addEventListener('play', () => {
    isPlaying = true;
    playPauseBtn.textContent = '⏸';
  });

  audio.addEventListener('pause', () => {
    isPlaying = false;
    playPauseBtn.textContent = '▶';
  });

  audio.addEventListener('timeupdate', () => {
    const percent = (audio.currentTime / audio.duration) * 100;
    progressBar.value = percent || 0;
    currentTimeEl.textContent = formatTime(audio.currentTime);
  });

  audio.addEventListener('loadedmetadata', () => {
    durationTimeEl.textContent = formatTime(audio.duration);
  });

  audio.addEventListener('ended', () => {
    if (currentEpisodeIndex < episodes.length - 1) {
      playEpisode(currentEpisodeIndex + 1);
    }
  });

  // UI Controls
  playPauseBtn.addEventListener('click', () => {
    if (currentEpisodeIndex === -1) {
      playEpisode(0);
    } else {
      isPlaying ? audio.pause() : audio.play();
    }
  });

  prevBtn.addEventListener('click', () => {
    if (currentEpisodeIndex > 0) playEpisode(currentEpisodeIndex - 1);
  });

  nextBtn.addEventListener('click', () => {
    if (currentEpisodeIndex < episodes.length - 1) playEpisode(currentEpisodeIndex + 1);
  });

  progressBar.addEventListener('input', () => {
    const time = (progressBar.value / 100) * audio.duration;
    audio.currentTime = time;
  });

  volumeBar.addEventListener('input', () => {
    audio.volume = volumeBar.value / 100;
  });

  // Search & Filters
  const handleFilters = () => {
    const query = searchInput.value.toLowerCase();
    const activeCat = document.querySelector('.filter-btn.active').dataset.category;

    const filtered = episodes.filter(ep => {
      const matchesSearch = ep.title.toLowerCase().includes(query) || 
                            ep.desc.toLowerCase().includes(query) ||
                            ep.tags.some(t => t.includes(query));
      const matchesCat = activeCat === 'all' || ep.category === activeCat;
      return matchesSearch && matchesCat;
    });

    renderEpisodes(filtered);
  };

  searchInput.addEventListener('input', handleFilters);
  
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      handleFilters();
    });
  });

  // Initialize
  if (isHomePage) {
    renderEpisodes(episodes.slice(0, 2)); // Only show 2 latest on home
  } else {
    renderEpisodes(episodes);
  }
  audio.volume = 0.8;

  // Prevent spacebar from scrolling when playing
  window.addEventListener('keydown', (e) => {
    if (e.code === 'Space' && e.target === document.body) {
      e.preventDefault();
      playPauseBtn.click();
    }
  });

})();