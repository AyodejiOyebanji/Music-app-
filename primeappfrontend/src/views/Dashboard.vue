<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Prime</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Featured</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Artists</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Music</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Player</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/uploadMusic">Upload Music</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- overlay section -->
    <section class="hero">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center">
        <h1 class="hero-title">Welcome to  Prime</h1>
        <p class="hero-subtitle">Discover amazing things with us</p>
       
      </div>
    </div>
  </div>
</section>


    <div class="container">
    <h5 class="section-title">Popular Musicians</h5>
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMQbGaf8B6XygBQ3EJAzcuIaVEMW1ONJ4oGg&usqp=CAU" class="card-img-top" alt="Musician 1">
          <div class="card-body">
            <h5 class="card-title">Musician 1</h5>
            <a href="#" class="btn btn-primary">More Info</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMQbGaf8B6XygBQ3EJAzcuIaVEMW1ONJ4oGg&usqp=CAU" class="card-img-top" alt="Musician 2">
          <div class="card-body">
            <h5 class="card-title">Musician 2</h5>
            <a href="#" class="btn btn-primary">More Info</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMQbGaf8B6XygBQ3EJAzcuIaVEMW1ONJ4oGg&usqp=CAU" class="card-img-top" alt="Musician 3">
          <div class="card-body">
            <h5 class="card-title">Musician 3</h5>
            <a href="#" class="btn btn-primary">More Info</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMQbGaf8B6XygBQ3EJAzcuIaVEMW1ONJ4oGg&usqp=CAU" class="card-img-top" alt="Musician 4">
          <div class="card-body">
            <h5 class="card-title">Musician 4</h5>
            <a href="#" class="btn btn-primary">More Info</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="listing" v-for="(music, index) in newMusic" :key="index" :class="{ 'active': music.playing }">
      <img :src="music.cover" alt="Music Cover" class="cover-image">
      <div class="listing-content">
        <h4 class="music-name">{{ music.title }}</h4>
        <p>{{ music.artist }}</p>
        <div class="progress-bar" @click="handleProgressBarClick(index, $event)">
          <div class="progress-bar-fill" :style="{ width: progressBarWidth[index] + '%' }"></div>

          <div class="progress-bar-handle" ref="progressBarHandle"></div>
        </div>
        <span class="duration">{{ formatTime(music.currentTime) }}</span>
        <span class="duration">{{ music.duration }}</span>
      </div>
      <button class="play-pause-btn" @click="togglePlay(index)">
        <span class="material-symbols-outlined">
          {{ music.playing ? 'pause_circle' : 'play_circle' }}
        </span>
      </button>
      <audio :src="music.audio" ref="audioPlayers" :id="'audioPlayer_' + index" class="audio-player" @timeupdate="updateAudioCurrentTime(index)"></audio>
    </div>

  </template>
  
<script>
import axios from 'axios';
axios.defaults.withCredentials = true;
export default {
  mounted() {
    this.getMusic();
    
    // Check if the token exists in localStorage
    const token = localStorage.getItem('prime_music');

    if (token) {
      
      fetch('http://localhost/PrimeApp/PrimeApp/public/api/currentuser', {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        credentials: 'include'
      })
  .then(response => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error('Unable to fetch user data');
    }
  })
  .then(data => {
    console.log(data);
    const userData = data.user;
  })
  .catch(error => {
    console.error(error);
  });

      
    } else {
      // Token does not exist, redirect to sign-in page
      this.$router.push('/signin');
    }
  },
  data() {
    return {
      allUsers: [],
      newMusic: [],
      seekingIndex: null,
      progressBarWidth: []
    };
  },
  methods: {
    getMusic() {
  let url = "https://musica-api.up.railway.app/new";
  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      this.newMusic = data;
      console.log(data);
    })
    .catch((error) => {
      console.error("Error fetching music:", error);
    });
}, togglePlay(index) {
    const audioPlayer = this.$refs.audioPlayers[index];
    if (audioPlayer.paused) {
      audioPlayer.play();
      this.pauseOthers(index);
    } else {
      audioPlayer.pause();
    }
    this.newMusic[index].playing = !audioPlayer.paused;
  },
  pauseOthers(index) {
    this.newMusic.forEach((music, i) => {
      if (i !== index) {
        const audioPlayer = this.$refs.audioPlayers[i];
        audioPlayer.pause();
        music.playing = false;
      }
    });
  },
  audioCurrentTime(index) {
    const audioPlayer = this.$refs.audioPlayers[index];
    return audioPlayer ? audioPlayer.currentTime : 0;
  },
  updateAudioCurrentTime(index) {
      const audioPlayer = this.$refs.audioPlayers[index];
      const duration = audioPlayer.duration;
      const currentTime = audioPlayer.currentTime;
      this.progressBarWidth[index] = (currentTime / duration) * 100;
    },
  formatTime(time) {
    if (isNaN(time) || time === 0) {
      return '0:00';
    }
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
  },
  calculateProgress(index) {
      const music = this.newMusic[index];
      if (music.duration > 0) {
        return (music.currentTime / music.duration) * 100;
      }
      return 0;
    },
    handleProgressBarClick(index, event) {
      const progressBar = event.currentTarget;
      const progressBarRect = progressBar.getBoundingClientRect();
      const offsetX = event.clientX - progressBarRect.left;
      const progressBarWidth = progressBarRect.width;
      const progress = offsetX / progressBarWidth;
      const audioPlayer = this.$refs.audioPlayers[index];
      audioPlayer.currentTime = audioPlayer.duration * progress;
    },

    updateAudioCurrentTime(index) {
      const audioPlayer = this.$refs.audioPlayers[index];
      this.newMusic[index].currentTime = audioPlayer.currentTime;
    },
  },
  startSeek(index) {
    this.seekingIndex = index;
    this.pauseAll(index);
    document.addEventListener('mousemove', this.handleSeek);
    document.addEventListener('mouseup', this.endSeek);
  },

  handleSeek(event) {
    if (this.seekingIndex !== null) {
      const audioPlayer = this.$refs.audioPlayers[this.seekingIndex];
      const progressBar = event.target.closest('.progress-bar');
      const progressBarWidth = progressBar.clientWidth;
      const offsetX = event.clientX - progressBar.getBoundingClientRect().left;
      const progress = offsetX / progressBarWidth;
      audioPlayer.currentTime = audioPlayer.duration * progress;
    }
  },

  endSeek() {
    document.removeEventListener('mousemove', this.handleSeek);
    document.removeEventListener('mouseup', this.endSeek);
    this.resumeAll();
    this.seekingIndex = null;
  },

  pauseAll(exceptIndex) {
    this.newMusic.forEach((music, index) => {
      if (index !== exceptIndex) {
        music.playing = false;
        const audioPlayer = this.$refs.audioPlayers[index];
        audioPlayer.pause();
      }
    });
  },

  resumeAll() {
    this.newMusic.forEach((music, index) => {
      if (music.playing) {
        const audioPlayer = this.$refs.audioPlayers[index];
        audioPlayer.play();
      }
    });
  
  },
}

</script>

  <style>
  /* Add your custom styles here */
  .section-title {
 
  margin-bottom: 30px;
}

.card {
  margin-bottom: 20px;
}

.card-img-top {
  height: 200px;
  object-fit: cover;
}

.card-title {
  margin-bottom: 10px;
}
.hero {
  position: relative;
  background-image: url('../assets/download.jpg');
  background-size: cover;
  background-position: center;
  height: 50vh;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 50vh;
  background-color: rgba(0, 0, 0, 0.5);
}

.hero-title {
  font-size: 3rem;
  color: #fff;
  margin-top: 100px;
}

.hero-subtitle {
  font-size: 1.5rem;
  color: #fff;
  margin-bottom: 30px;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
    margin-top: 150px;
  }

  .hero-subtitle {
    font-size: 1.2rem;
  }
}
.listing {
  width: 100%;
  height: 20vh;
  background-color: #f5f5f5;
  display: flex;
  align-items: center;
  padding: 10px;
}

.cover-image {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 4px;
  margin-right: 10px;
}

.listing-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex-grow: 1;
}

.music-name {
  margin-bottom: 5px;
  font-size: 18px;
  font-weight: bold;
  color: #333;
}

.controls {
  display: flex;
  align-items: center;
}

.play-pause-btn {
  width: 30px;
  height: 30px;
  background-color: #428bca;
  color: #fff;
  border: none;
  border-radius: 50%;
  font-size: 16px;
  margin-right: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s ease;
}

.play-pause-btn:hover {
  background-color: #337ab7;
}

.duration {
  font-size: 14px;
  color: #777;
}
.listing.active {
  background-color: #eaeaea;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  animation: glowEffect 1s ease-in-out infinite alternate;
}

@keyframes glowEffect {
  0% {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }
  100% {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
  }}
  .progress-bar {
  width: 100%;
  height: 6px;
  background-color: #ccc;
  cursor: pointer;
  position: relative;
}

.progress-bar-fill {
  height: 100%;
  background-color: #2196f3;
  width: 0;
  transition: width 0.3s ease-in-out;
}

.progress-bar-handle {
  width: 10px;
  height: 10px;
  background-color: #2196f3;
  position: absolute;
  top: -2px;
  border-radius: 50%;
  transform: translateX(-50%);
  cursor: pointer;
}

.duration {
  display: block;
  margin-top: 5px;
  font-size: 12px;
  color: #999;
}

  </style>
  