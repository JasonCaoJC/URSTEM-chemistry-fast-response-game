
(function ($) {
    "use strict";
    /* [Focus input] */
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })

    /* [Validate] */
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function () {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });

    $('.validate-form .input100').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    $('#login').on('hidden.bs.modal', function() {
        return false;
      });
})(jQuery);

//Tile class. Holds information needed for the tiles to work properly.
class Tile {
    constructor(parentNode, imgSrc, tag, disabled, front, back) {
        this.parentNode = parentNode;
        this.imgSrc = imgSrc;
        this.tag = tag;
        this.disabled = disabled;
        this.front = front;
        this.back = back;
    }
}

$(document).ready(function () {
    const MAX_TILES = 16;
    const suffix = ".gif";
    const leftBar = document.getElementById("left-bar");
    const backBtn = document.getElementById("back-btn");
    const selectAllBtn = document.getElementById("select-all-btn");
    backBtn.onclick = function () {
        leftBar.classList.remove("left-bar-activated");
    }
    let tiles = [], openTiles = [];
    let imgs = [], imgsSelected = [], imgsShuffled = [];
    let selected = false; //default (no options are chosen)
    let parentNode;
    let s = 0, m = 0; h = 0;
    let interval;
    const second = document.getElementById("second");
    const minute = document.getElementById("minute");
    const hour = document.getElementById("hour");
    const move = document.getElementById("move");
    let moves = 0;
    const match = document.getElementById("matched");
    let matches = 0;

    function disableAllCards() {
        let cardsGroup;
        for (let i = 0; i < 16; i++) {
            cardsGroup = document.getElementById("card-" + (i + 1));
            cardsGroup.classList.add("mouse-disabled");
        }
    }

    function enableAllCards() {
        let cardsGroup;
        for (let i = 0; i < 16; i++) {
            cardsGroup = document.getElementById("card-" + (i + 1));
            cardsGroup.classList.remove("mouse-disabled");
        }
    }

    function restoreCards() {
        let cardFront, cardBack, cardsGroup;
        for (let i = 0; i < 16; i++) {
            cardFront = document.getElementById("c" + (i + 1) + "-front");
            cardFront.classList.remove("disabled");
            cardBack = document.getElementById("c" + (i + 1) + "-back");
            cardBack.classList.remove("disabled");
            cardsGroup = document.getElementById("card-" + (i + 1));
            cardsGroup.classList.remove("is-flipped");
        }
    }

    function disableAllTags() {
        let tagDescription = document.getElementById("tag-description");
        tagDescription.innerHTML = "Matched pairs:";
        let tagGroup = document.getElementById("tag-group");
        tagGroup.classList.add("none-display");
        let tags = document.querySelectorAll(".tag-select");
        tags.forEach(tag => {
            tag.classList.add("mouse-disabled");
        });
    }

    function enableAllTags() {
        let tagDescription = document.getElementById("tag-description");
        tagDescription.innerHTML = "Choose materials to review:";
        let tagGroup = document.getElementById("tag-group");
        tagGroup.classList.remove("none-display");
        let tags = document.querySelectorAll(".tag-select");
        tags.forEach(tag => {
            tag.classList.remove("mouse-disabled");
        });
        document.getElementById("matched-pairs").innerHTML = "";
    }

    function generateMaterial(imgs) {
        let options = document.getElementById("options-group");
        options.innerHTML = "";
        for (let i = 0; i < imgs.length / 2; i++) {
            let div = document.createElement("div");
            div.className = "checkbox flex-row";
            let div1 = document.createElement("div");
            div1.className = "imgs";
            let img1 = document.createElement("img");
            let img2 = document.createElement("img");
            img1.src = imgs[i];
            img2.src = imgs[i + imgs.length / 2];
            div1.appendChild(img1);
            div1.appendChild(img2);
            let div2 = document.createElement("div");
            div2.className = "form-check";
            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input";
            checkbox.id = "c" + i;
            div2.appendChild(checkbox);
            div.appendChild(div1);
            div.appendChild(div2);
            options.appendChild(div);
        }
    }

    function generateArray(maxTile, prefix) {
        let arrayGenerated = [];
        for (let i = 1; i <= maxTile; i++) {
            if (i < 10) {
                arrayGenerated.push("images/" + prefix + "0" + i + "_a" + suffix);
            } else {
                arrayGenerated.push("images/" + prefix + i + "_a" + suffix);
            }
        }
        for (let i = 1; i <= maxTile; i++) {
            if (i < 10) {
                arrayGenerated.push("images/" + prefix + "0" + i + "_b" + suffix);
            } else {
                arrayGenerated.push("images/" + prefix + i + "_b" + suffix);
            }
        }
        return arrayGenerated;
    }

    function init() {
        ///Orbitals tag select
        let node = document.getElementById('orbitals');
        let materialTitle = document.getElementById("material-title");
        let description = document.getElementById("description");
        node.onclick = function () {
            let prefix = "orbitals/orb";
            imgs = generateArray(12, prefix);
            materialTitle.innerHTML = "Orbitals";
            description.innerHTML = "Match the orbital type with its image. Select the pairs you wish to match. If you do not choose the computer will choose for you."
            generateMaterial(imgs);
            select();
        }

        ///Fuctional groups tag select 
        node = document.getElementById('func_group');
        node.onclick = function () {
            prefix = "func_group/fg";
            imgs = generateArray(15, prefix);
            materialTitle.innerHTML = "Functional Groups";
            description.innerHTML = "Match the name of the functional group with its chemical structure. Select the pairs you wish to match. If you do not choose the computer will choose for you."
            generateMaterial(imgs);
            select();
        }

        ///pKas groups tag select 
        node = document.getElementById('pkas');
        node.onclick = function () {
            prefix = "pka/pka";
            imgs = generateArray(13, prefix);
            materialTitle.innerHTML = "pKa's";
            description.innerHTML = "Match the molecules with their pKa's. Select the pairs you wish to match. If you do not choose the computer will choose for you."
            generateMaterial(imgs);
            select();
        }

        //1H NMR Chemical Shifts groups tag select
        node = document.getElementById('hnmr');
        node.onclick = function () {
            prefix = "nmrH/hnmr-";
            imgs = generateArray(13, prefix);
            materialTitle.innerHTML = "1H NMR Chemical Shifts";
            description.innerHTML = "Match the structures with their chemical shifts. Select the pairs you wish to match. If you do not choose the computer will choose for you.";
            generateMaterial(imgs);
            select();
        }

        //Styrene groups tag select
        node = document.getElementById('styrene');
        node.onclick = function () {
            prefix = "styrene/rxnc";
            imgs = generateArray(9, prefix);
            materialTitle.innerHTML = "Styrene";
            description.innerHTML = "Match the reagents and products for the reactions of styrene. Select the pairs you wish to match. If you do not choose the computer will choose for you.";
            generateMaterial(imgs);
            select();
        }

        //1-Methylcyclohexene groups tag select
        node = document.getElementById('methylcyclohexene');
        node.onclick = function () {
            prefix = "cyclohexene/chex";
            imgs = generateArray(9, prefix);
            materialTitle.innerHTML = "1-Methylcyclohexene";
            description.innerHTML = "Match the reagents and products for the reactions of methylcyclohexene. Select the pairs you wish to match. If you do not choose the computer will choose for you.";
            generateMaterial(imgs);
            select();
        }

        //IR groups tag select
        node = document.getElementById('ir');
        node.onclick = function () {
            prefix = "IR/ir";
            imgs = generateArray(10, prefix);
            materialTitle.innerHTML = "IR";
            description.innerHTML = "Match the functional groups with the IR frequencies below. Select the pairs you wish to match. If you do not choose, the computer will automatically choose for you.<br> IR shifts were adapted from the URL: webspectra.chem.ucla.edu/irtable.html";
            generateMaterial(imgs);
            select();
        }

        //SN2 groups tag select
        node = document.getElementById('sn2');
        node.onclick = function () {
            prefix = "sn2/sn2-";
            imgs = generateArray(9, prefix);
            materialTitle.innerHTML = "SN2";
            description.innerHTML = "Match the components of the SN2 reaction below. Select the pairs you wish to match. If you do not choose the computer will choose for you.";
            descriptionImg = document.createElement("img");
            descriptionImg.src = "images/" + prefix + "rxn" + suffix;
            description.appendChild(descriptionImg);
            generateMaterial(imgs);
            select();
        }

        //Acronyms groups tag select
        node = document.getElementById('acronyms');
        node.onclick = function () {
            prefix = "acronyms/acro";
            imgs = generateArray(13, prefix);
            materialTitle.innerHTML = "Acronyms";
            description.innerHTML = "Match the acronym with its chemical structure. Select the pairs you wish to match. If you do not choose the computer will choose for you.";
            generateMaterial(imgs);
            select();
        }

        //Amino Acids: Structure to Name groups tag select
        node = document.getElementById('aa-sn');
        node.onclick = function () {
            prefix = "aa-sn/aa";
            imgs = generateArray(20, prefix);
            materialTitle.innerHTML = "Amino Acids: Structure to Name";
            description.innerHTML = "Match the amino acid structure on the left with the name on the right";
            generateMaterial(imgs);
            select();
        }

        //Amino Acids: Structure to 3-letter code groups tag select
        node = document.getElementById('aa-s3');
        node.onclick = function () {
            prefix = "aa-s3/aa";
            imgs = generateArray(20, prefix);
            materialTitle.innerHTML = "Amino Acids: Structure to 3-letter code";
            description.innerHTML = "Match the amino acid structure on the left with the 3-letter code on the right";
            generateMaterial(imgs);
            select();
        }

        //Amino Acids: Structure to 1-letter code groups tag select
        node = document.getElementById('aa-s1');
        node.onclick = function () {
            prefix = "aa-s1/aa";
            imgs = generateArray(20, prefix);
            materialTitle.innerHTML = "Amino Acids: Structure to 1-letter code";
            description.innerHTML = "Match the amino acid structure on the left with the 1-letter code on the right";
            generateMaterial(imgs);
            select();
        }
    }

    function setup() {
        enableAllTags();
        disableAllCards();
    }

    function select() {
        selectAllBtn.onclick = function () {
            imgsSelected = [];
            let checkbox;
            for (let i = 0; i < imgs.length / 2; i++) {
                checkbox = document.getElementById("c" + i);
                checkbox.checked = true;
                imgsSelected.push(imgs[i]);
                imgsSelected.push(imgs[i + imgs.length / 2]);
            }
            //console.log(imgsSelected);
            leftBar.classList.remove("left-bar-activated");
            disableAllTags();
            start();
        }
        node = document.getElementById("submit-btn");
        node.onclick = function () {
            imgsSelected = [];
            selected = false;
            let checkbox;
            for (let i = 0; i < imgs.length / 2; i++) {
                checkbox = document.getElementById("c" + i);
                if (checkbox.checked == true) {
                    imgsSelected.push(imgs[i]);
                    imgsSelected.push(imgs[i + imgs.length / 2]);
                }
            }
            if (imgsSelected.length < MAX_TILES) {
                alert("Please choose at least 8 components to play");
            } else {
                selected = true;
            }
            if (selected) {
                leftBar.classList.remove("left-bar-activated");
                disableAllTags();
                start();
            }
        }
    }

    function start() {
        enableAllCards();
        if (selected == false) {
            imgsShuffled = shuffle(imgs); //Shuffles the selected arrays.
        }
        else if (selected == true) {
            imgsShuffled = shuffle(imgsSelected);
        } 
        for (let i = 0; i < 16; i++) {
            let front = document.getElementById("c" + (i + 1) + "-front");
            let back = document.getElementById("c" + (i + 1) + "-back");
            back.src = imgsShuffled[i];
            parentNode = document.getElementById("card-" + (i + 1));
            let tile = new Tile(parentNode, imgsShuffled[i], imgsShuffled[i].substring(0, imgsShuffled[i].length - 6), 0, front, back);
            parentNode.onclick = function () {
                tileClick(tile);
            };
        }
    }

    function tileClick(tile) {
        //console.log(tile);
        openTiles.push(tile);
        if (openTiles.length == 1) {
            openTiles[0].parentNode.classList.add("mouse-disabled");
        }
        else if (openTiles.length == 2) {
            moveCounter();
            //console.log("Tile1: " + openTiles[0].tag);
            //console.log("Tile2: " + openTiles[1].tag);

            openTiles[1].parentNode.classList.add("mouse-disabled");

            if (openTiles[0].tag === openTiles[1].tag) {
                //console.log("Matched");
                matched(openTiles);
            } else {
                //console.log("Unmatched");
                unmatched(openTiles);
            }
            openTiles = [];
        }
    }

    function matched(openTiles) {
        matchedCounter();
        setTimeout(function () {
            openTiles[0].front.classList.add("disabled");
            openTiles[0].back.classList.add("disabled");
            openTiles[1].front.classList.add("disabled");
            openTiles[1].back.classList.add("disabled");
            openTiles[0].parentNode.onclick = '';
            openTiles[1].parentNode.onclick = '';
            matchedPairs(openTiles);
        }, 1100);
    }

    function matchedPairs(openTiles) {
        let matchedPairsPannel = document.getElementById("matched-pairs");
        let imgs = document.createElement("div");
        imgs.className = "imgs";
        let img1 = document.createElement("img");
        img1.src = openTiles[0].tag + "_a" + suffix;
        let img2 = document.createElement("img");
        img2.src = openTiles[0].tag + "_b" + suffix;
        imgs.appendChild(img1);
        imgs.appendChild(img2);
        matchedPairsPannel.appendChild(imgs);
    }

    function unmatched(openTiles) {
        openTiles[0].parentNode.classList.remove("mouse-disabled");
        openTiles[1].parentNode.classList.remove("mouse-disabled");
        setTimeout(function () {
            openTiles[0].parentNode.classList.remove("is-flipped");
            openTiles[1].parentNode.classList.remove("is-flipped");
        }, 1100);
    }

    //Shuffles the imgs[] array. 
    function shuffle(imgsA) {
        if (imgsA.length % 2 == 1) {
            alert("Uneven image set.");
        }
        let random, index, length;
        let imgsCopy = [];
        imgsCopy = imgsA.slice();
        let imgsRandom = [];
        //Code to randomize the arrays.
        if (imgsCopy.length == 16) {
            for (index = 0; index < 16; index++) {
                length = imgsCopy.length;
                random = (Math.floor(Math.random() * length));
                imgsRandom[index] = imgsCopy[random];
                imgsCopy.splice(random, 1);
            }
            return imgsRandom;
        }
        else if (imgsCopy.length > 16 && selected == false) {
            for (index = 0; index < 8; index++) {
                length = imgsCopy.length / 2;
                random = (Math.floor(Math.random() * length));
                imgsRandom[index] = imgsCopy[random];
                imgsRandom[index + 8] = imgsCopy[random + length];
                imgsCopy.splice(random + length, 1);
                imgsCopy.splice(random, 1);
            }
            imgsRandom = shuffle(imgsRandom);
            return imgsRandom;
        }
        else if (imgsCopy.length > 16 && selected == true) {
            for (index = 0; index < 8; index++) {
                random = (Math.floor(Math.random() * imgsCopy.length));
                if (random % 2 == 0) {
                    imgsRandom[index] = imgsCopy[random];
                    imgsRandom[index + 8] = imgsCopy[random + 1];
                    imgsCopy.splice(random + 1, 1);
                    imgsCopy.splice(random, 1);
                }
                else if (random % 2 == 1) {
                    imgsRandom[index] = imgsCopy[random];
                    imgsRandom[index + 8] = imgsCopy[random - 1];
                    imgsCopy.splice(random, 1);
                    imgsCopy.splice(random - 1, 1);
                }
            }
            imgsRandom = shuffle(imgsRandom);
            return imgsRandom;
        }
        else if (imgsCopy.length < 16 && selected == true) {
            length = imgs.length / 2
            while (imgsCopy.length < 16) {
                random = (Math.floor(Math.random() * length));
                if (imgsCopy.indexOf(imgs[random]) == -1) {
                    imgsCopy.push(imgs[random]);
                    imgsCopy.push(imgs[random + length]);
                }
            }
            imgsRandom = shuffle(imgsCopy);
            return imgsRandom;
        }
        else {
            alert("Not enough images in set");
            return imgsA;
        }
    }

    // @description game timer
    function startTimer() {
        interval = setInterval(function () {
            hour.innerHTML = (h < 10) ? "0" + h : h;
            minute.innerHTML = (m < 10) ? "0" + m : m;
            second.innerHTML = (s < 10) ? "0" + s : s;
            s++;
            if (s == 60) {
                m++;
                s = 0;
            }
            if (m == 60) {
                h++;
                m = 0;
            }
        }, 1000);
    }

    function moveCounter() {
        moves++;
        move.innerHTML = moves;
        if (moves === 1) {
            h = 0;
            m = 0;
            s = 0;
            startTimer();
        }
    }

    function matchedCounter() {
        matches++;
        match.innerHTML = matches;
        if (matches === MAX_TILES / 2) {
            setTimeout(function () {
                const container = document.getElementById("main-page");
                $("#congrats").modal("show");
                confetti({
                    spread: 70,
                    origin: { y: 0.5 },
                    zIndex: 10000
                });
                container.className = "container is-blurred";
                document.getElementById("final-moves").innerHTML = (moves < 10) ? "0" + moves : moves;
                document.getElementById("total-hours").innerHTML = (h < 10) ? "0" + h : h;
                document.getElementById("total-minutes").innerHTML = (m < 10) ? "0" + m : m;
                document.getElementById("total-seconds").innerHTML = (s < 10) ? "0" + s : s;
                clearInterval(interval);

                const playAgainBtn = document.getElementById("play-again");
                playAgainBtn.onclick = function () {
                    $("#congrats").modal("hide");
                    reset();
                    container.classList.remove("is-blurred");
                }
            }, 1100);
        }
    }

    const resetBtn = document.getElementById("reset-btn");
    resetBtn.onclick = reset;

    function reset() {
        //console.log("reset button is on click");
        restoreCards();
        tiles = [];
        openTiles = [];
        imgs = [];
        imgsSelected = [];
        imgsShuffled = [];
        selected = false;
        s = 0;
        m = 0;
        h = 0;
        moves = 0;
        matches = 0;
        hour.innerHTML = "00";
        minute.innerHTML = "00";
        second.innerHTML = "00";
        move.innerHTML = "0";
        match.innerHTML = "0";
        clearInterval(interval);
        setup();
    }

    init();
    setup();
});

const cardsGroups = document.querySelectorAll(".cards-group");
cardsGroups.forEach(cardsGroup => {
    cardsGroup.addEventListener("click", function () {
        cardsGroup.classList.add("is-flipped");
    })
})

const tagButtons = document.querySelectorAll('.tag-select');
tagButtons.forEach(tagButton => {
    tagButton.addEventListener('click', function () {
        document.getElementById('left-bar').classList.add('left-bar-activated');
    })
})

if (document.getElementById('login')) {
    const showModal = function () {
        let container = document.getElementById('main-page');
        $("#login").modal('show');
        container.className = "container login-container is-blurred";
    };
    const loginBtn = document.getElementById('btn-login');
    loginBtn.onclick = showModal;
}
/*
if (document.getElementById('congrats')) {
    //initialize instance
    var enjoyhint_instance = new EnjoyHint({});

    //simple config. 
    //Only one step - highlighting(with description) "New" button 
    //hide EnjoyHint after a click on the button.
    var enjoyhint_script_steps = [
        {
            'click #orbitals': 'Choose the material to review by clicking on one of these tags.'
        },
        {
            'next #options-group': 'Choose at least 8 pairs you wish to appear in the game.'
        },
        {
            'click #submit-btn': 'After select all pairs, click the "Submit" button to start the game.'
        },
        {
            'click #reset-btn': 'Click the "Reset" button if you wish to restart the game and choose another material to review.'

        }
    ];

    //set script config
    enjoyhint_instance.set(enjoyhint_script_steps);

    //run Enjoyhint script
    enjoyhint_instance.run();

}
*/




