<!DOCTYPE html>
<html>
  <head>
    <title>JS Video Player</title>
    <!-- https://fonts.google.com/icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="video.css"/>
    <script type="text/javascript">
      window.addEventListener("DOMContentLoaded", () => {
  // (A) PLAYER INIT
  // (A1) PLAYLIST - CHANGE TO YOUR OWN!
  let playlist = [
    {name: "Video A", src: "/home/recorder/grabaciones/javibot00-20211212-222848.mp4"}
  ];

  // (A2) VIDEO PLAYER & GET HTML CONTROLS
  const video = document.getElementById("vVid"),
        vPlay = document.getElementById("vPlay"),
        vPlayIco = document.getElementById("vPlayIco"),
        vNow = document.getElementById("vNow"),
        vTime = document.getElementById("vTime"),
        vSeek = document.getElementById("vSeek"),
        vVolume = document.getElementById("vVolume"),
        vVolIco = document.getElementById("vVolIco"),
        vList = document.getElementById("vList");

  // (A3) BUILD PLAYLIST
  for (let i in playlist) {
    let row = document.createElement("div");
    row.className = "vRow";
    row.innerHTML = playlist[i]["name"];
    row.addEventListener("click", () => { vidPlay(i); });
    playlist[i]["row"] = row;
    vList.appendChild(row);
  }

  // (B) PLAY MECHANISM
  // (B1) FLAGS
  var vidNow = 0, // current video
      vidStart = false, // auto start next video

  // (B2) PLAY SELECTED VIDEO
  vidPlay = (idx, nostart) => {
    vidNow = idx;
    vidStart = nostart ? false : true;
    video.src = playlist[idx]["src"];
    for (let i in playlist) {
      if (i == idx) { playlist[i]["row"].classList.add("now"); }
      else { playlist[i]["row"].classList.remove("now"); }
    }
  };

  // (B3) AUTO START WHEN SUFFICIENTLY BUFFERED
  video.addEventListener("canplay", () => { if (vidStart) {
    video.play();
    vidStart = false;
  }});

  // (B4) AUTOPLAY NEXT VIDEO IN THE PLAYLIST
  video.addEventListener("ended", () => {
    vidNow++;
    if (vidNow >= playlist.length) { vidNow = 0; }
    vidPlay(vidNow);
  });

  // (B5) INIT SET FIRST VIDEO
  vidPlay(0, true);

  // (C) PLAY/PAUSE BUTTON
  // (C1) AUTO SET PLAY/PAUSE TEXT
  video.addEventListener("play", () => {
    vPlayIco.innerHTML = "pause";
  });
  video.addEventListener("pause", () => {
    vPlayIco.innerHTML = "play_arrow";
  });

  // (C2) CLICK TO PLAY/PAUSE
  vPlay.addEventListener("click", () => {
    if (video.paused) { video.play(); }
    else { video.pause(); }
  });

  // (D) TRACK PROGRESS
  // (D1) SUPPORT FUNCTION - FORMAT HH:MM:SS
  var timeString = (secs) => {
    // HOURS, MINUTES, SECONDS
    let ss = Math.floor(secs),
        hh = Math.floor(ss / 3600),
        mm = Math.floor((ss - (hh * 3600)) / 60);
    ss = ss - (hh * 3600) - (mm * 60);

    // RETURN FORMATTED TIME
    if (hh>0) { mm = mm<10 ? "0"+mm : mm; }
    ss = ss<10 ? "0"+ss : ss;
    return hh>0 ? `${hh}:${mm}:${ss}` : `${mm}:${ss}` ;
  };

  // (D2) INIT SET TRACK TIME
  video.addEventListener("loadedmetadata", () => {
    vNow.innerHTML = timeString(0);
    vTime.innerHTML = timeString(video.duration);
  });

  // (D3) UPDATE TIME ON PLAYING
  video.addEventListener("timeupdate", () => {
    vNow.innerHTML = timeString(video.currentTime);
  });

  // (E) SEEK BAR
  video.addEventListener("loadedmetadata", () => {
    // (E1) SET SEEK BAR MAX TIME
    vSeek.max = Math.floor(video.duration);

    // (E2) USER CHANGE SEEK BAR TIME
    var vSeeking = false; // USER IS NOW CHANGING TIME
    vSeek.addEventListener("input", () => {
      vSeeking = true; // PREVENTS CLASH WITH (E3)
    });
    vSeek.addEventListener("change", () => {
      video.currentTime = vSeek.value;
      if (!video.paused) { video.play(); }
      vSeeking = false;
    });

    // (E3) UPDATE SEEK BAR ON PLAYING
    video.addEventListener("timeupdate", () => {
      if (!vSeeking) { vSeek.value = Math.floor(video.currentTime); }
    });
  });

  // (F) VOLUME
  vVolume.addEventListener("change", () => {
    video.volume = vVolume.value;
    vVolIco.innerHTML = (vVolume.value==0 ? "volume_mute" : "volume_up");
  });

  // (G) ENABLE/DISABLE CONTROLS
  video.addEventListener("canplay", () => {
    vPlay.disabled = false;
    vVolume.disabled = false;
    vSeek.disabled = false;
  });
  video.addEventListener("waiting", () => {
    vPlay.disabled = true;
    vVolume.disabled = true;
    vSeek.disabled = true;
  });
});

    </script>
  </head>
  <body>
    <div id="vWrap">
      <!-- (A) VIDEO TAG -->
      <video id="vVid"></video>

      <!-- (B) PLAY/PAUSE BUTTON -->
      <button id="vPlay" disabled><span id="vPlayIco" class="material-icons">
        play_arrow
      </span></button>

      <!-- (C) TIME -->
      <div id="vCron">
        <span id="vNow"></span> / <span id="vTime"></span>
      </div>

      <!-- (D) SEEK BAR -->
      <input id="vSeek" type="range" min="0" value="0" step="1" disabled/>

      <!-- (E) VOLUME SLIDE -->
      <span id="vVolIco" class="material-icons">volume_up</span>
      <input id="vVolume" type="range" min="0" max="1" value="1" step="0.1" disabled/>

      <!-- (F) PLAYLIST -->
      <div id="vList"></div>
    </div>
  </body>
</html>
