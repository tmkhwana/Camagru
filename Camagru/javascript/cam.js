var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    video = document.getElementById('video'),
    capture = document.getElementById('capture'),
    pic = document.getElementById('img');

(function(){ 
    navigator.getMedia = navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia;

    navigator.getMedia({
        video: {width: 400, height: 300},
        audio: false
    }, function(stream){
        video.srcObject = stream;
        video.play();
    }, function(error){
        //An error occured
        console.log('I don\'t want you to use my camera');
    });

    capture.addEventListener('click', function () {
        context.drawImage(video, 0, 0, 400, 300);
        pic.value = canvas.toDataURL('image/png');
    }, false);

    document.getElementById('clear').addEventListener('click', function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
    });
    
})();

function addSticker(id, xvalue, yvalue){
    let img = document.getElementById(id);
    context.drawImage(img, xvalue, yvalue, 100, 100);
    pic.value = canvas.toDataURL('image/png');
}