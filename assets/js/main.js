/* 
var audioloader = WaveSurfer.create({
    container: '.audio',
    waveColor: 'violet',
    progressColor: 'red',
    barWidth: 2,
});



audioloader.load('https://drive.google.com/uc?export=download&id=1X94pQKC__T4STuYGL6mctCCX4E_VkEfg');


const playbtn = document.querySelector(".play-btn");
const stopbtns = document.querySelector(".stop-btn");
const mutebtn = document.querySelector(".volume-btn");
const volumeslider = document.querySelector(".volume-slider");


playbtn.addEventListener("click", () =>{
    audioloader.playPause();
    if(audioloader.isPlaying()){
        playbtn.classList.add("playing");
    }else{
        playbtn.classList.remove("playing");
    }
});


stopbtns.addEventListener("click", () =>{
    audioloader.stop();
    playbtn.classList.remove("playing");
});

volumeslider.addEventListener("mouseup", () =>{
 changevolume(volumeslider.value);
});

mutebtn.addEventListener("click", () =>{
if(mutebtn.classList.contains("muted")){
    mutebtn.classList.remove("muted");
    audioloader.setVolume(0.5);
    volumeslider.value = 0;
}else{
    audioloader.setVolume(0);
    mutebtn.classList.add("muted");
    volumeslider.value = 0;
}
});


const changevolume =(e) =>{
    if(e == 0){
    mutebtn.classList.add("muted");    
    }else{
    mutebtn.classList.remove("muted");
    }
    audioloader.setVolume(e);
}
*/
