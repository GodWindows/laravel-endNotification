var page = 1
var nbDays = {"day": 1, "month": 30, "year": 365};
previousButton = document.getElementById("previous")
nextButton = document.getElementById("next")
show_step(1)

function show_step(num) {
    for (let index = 1; index < 5; index++) {
        id='step-'+index
        step = document.getElementById(id)
        if (index==num) {
            step.style.display= 'block'
            console.log("step "+index+ " showed!");
        } else {
            step.style.display= 'none'
        }
    }
    handleButtons()
}

function previous_() {
    if (page>1) {
        page--
        show_step(page)
    }
}

function next_() {
    if (page == 3 ) {
        check_step3()
    }
    if (page == 2 ) {
        check_step2()
    }
    if (page == 1 ) {
        check_step1()
    }
}

function handleButtons() {
    if (page==1) {
        previousButton.style.visibility = 'hidden'
        nextButton.style.visibility = 'visible   '
    } else if (page==4){
        nextButton.style.visibility = 'hidden'
        previousButton.style.visibility = 'visible'
    }
    else
    {
        nextButton.style.visibility = 'visible'
        previousButton.style.visibility = 'visible'
    }
}

function check_step1() {
    if ($("#name")[0].checkValidity() && $("#email")[0].checkValidity()){
        page++
        show_step(page)
    }else{
        $("#email")[0].reportValidity()
        $("#name")[0].reportValidity()
    }
}

function check_step2() {
    var radios = document.getElementsByName("dmy");
    var isdmySelected = Array.from(radios).some(radio => radio.checked);
    if ($("#time")[0].checkValidity() && $("#start_date")[0].checkValidity()){
        if(isdmySelected){
            page++
            show_step(page)
        }else{
            toast('Choisissez entre jours, mois et années')
        }
    }else{
        $("#time")[0].reportValidity()
        $("#start_date")[0].reportValidity()
    }
}

function check_step3() {
    var radios = document.getElementsByName("freq_dmy");
    var isfreqDmySelected = Array.from(radios).some(radio => radio.checked);
    if ($("#freq_time")[0].checkValidity()){
        if (isfreqDmySelected) {
            if (durationIsGreaterThanFrequency()) {
                page++
                show_step(page)
            }else{
                toast('La fréquence de rappel doit être inférieure à la durée du projet')
            }
        }else{
            toast('Choisissez entre jours, mois et années')
        }
    }else{
        $("#freq_time")[0].reportValidity()
    }
}

function toast(message) {
    $.toast({
        heading: 'Attention',
        text: message,
        showHideTransition: 'fade',
        icon: 'warning'
    })
}

function durationIsGreaterThanFrequency() {
    const freq_dmyGroup = document.getElementsByName('freq_dmy');
    const dmyGroup = document.getElementsByName('dmy');
    var duration = $("#time")[0].value
    var frequency = $("#freq_time")[0].value
    var dmy = '';
    var freq_dmy = '';

    for (let i = 0; i < dmyGroup.length; i++) {
        if (dmyGroup[i].checked) {
            dmy = dmyGroup[i].value;
            break;
        }
    }

    for (let i = 0; i < freq_dmyGroup.length; i++) {
        if (freq_dmyGroup[i].checked) {
            freq_dmy = freq_dmyGroup[i].value;
            break;
        }
    }
    return duration*nbDays[dmy] > frequency*nbDays[freq_dmy]

}
