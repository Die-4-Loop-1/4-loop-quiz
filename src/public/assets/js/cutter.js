

// Fisher-Yates shuffle algorithm
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

//fills container with imgs from cutter
if (typeof haveImage !== 'undefined') {
    console.time('create img elements');
    for (let i = 0; i < images.length; i++) {
        let image = document.createElement('img');
        image.src = images[i];
        document.getElementById('imageContainer').appendChild(image);
    }
    console.timeEnd('create img elements');

    console.time('bunch up');
    let theWholeBunch = Array.from(document.querySelectorAll('img'));
    let theRandomBunch = shuffle(theWholeBunch);
    console.timeEnd('bunch up');
    //imgCounter multiplyed ba target value of img shown in precent when timer up. (imgCounter * .6) = 60%
    let delay = (countdown *1000) / (imgCounter * .6);
    
    //loop throu all imgs to dispaly them. just one time, Danke Ray
    window.onload = function() {
        
        console.timeEnd('page loaded');
        for (let i = 0; i < imgCounter+1; i++) {
            setTimeout(() => {
                theRandomBunch[i].style.opacity = 1;
            }, delay*i)
        }
    }
}


if (typeof haveImage !== 'undefined') {
    let con = document.getElementById('imageContainer');
    con.style.display = "flex";
}
else {
    let con = document.getElementById('xxx');
    con.style.display = "block";
    console.log('loged')
}


