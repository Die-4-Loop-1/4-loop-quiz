function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

if (haveImage) {
    console.time('create img elements');
    for (let i = 0; i < images.length; i++) {
        let image = document.createElement('img');
        // let imageUrl = 'cutterImgs/' + images[i];
        // image.src = imageUrl;
        image.src = images[i];
        document.getElementById('imageContainer').appendChild(image);
    }
    console.timeEnd('create img elements');

    console.time('bunch up');
    let theWholeBunch = Array.from(document.querySelectorAll('img'));
    let theRandomBunch = shuffle(theWholeBunch);
    let delay = (countdown *1000) / (imgCounter * .6);
    console.timeEnd('bunch up');
    
    window.onload = function() {
        console.timeEnd('page loaded');
        for (let i = 0; i < imgCounter+1; i++) {
            setTimeout(() => {
                theRandomBunch[i].style.opacity = 1;
            }, delay*i)
        }
    }
}