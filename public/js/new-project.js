var page = 1
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
    var genderRadios = document.getElementsByName("dmy");
    var isdmySelected = Array.from(genderRadios).some(radio => radio.checked);
    if ($("#time")[0].checkValidity() && $("#start_date")[0].checkValidity()){
        if(isdmySelected){
            page++
            show_step(page)
        }else{
            $.toast({
                heading: 'Attention',
                text: 'Choisissez entre jours, mois et années',
                showHideTransition: 'fade',
                icon: 'warning'
            })
        }
    }else{
        $("#time")[0].reportValidity()
        $("#start_date")[0].reportValidity()
    }
}

function check_step3() {
    var genderRadios = document.getElementsByName("freq_dmy");
    var isfreqDmySelected = Array.from(genderRadios).some(radio => radio.checked);
    if ($("#freq_time")[0].checkValidity()){
        if (isfreqDmySelected) {
            page++
            show_step(page)
        }else{
            $.toast({
                heading: 'Attention',
                text: 'Choisissez entre jours, mois et années',
                showHideTransition: 'fade',
                icon: 'warning'
            })
        }
    }else{
        $("#freq_time")[0].reportValidity()
    }
}

function app() {
    return {
        step: 1,
        dmy: '',
        freq_dmy: '',
        updateFrequencyMax() {
            const duration = parseInt(document.getElementById('time').value);
            let maxFrequency;


            if (this.dmy === 'year') {
                if (this.freq_dmy === 'day') {
                    maxFrequency = duration * 365;
                } else if (this.freq_dmy === 'month') {
                    maxFrequency = duration * 12;
                } else if (this.freq_dmy === 'year'){
                    maxFrequency = duration;
                }
            } else if (this.dmy === 'month') {
                if (this.freq_dmy === 'day') {
                    maxFrequency = duration * 30;
                } else {
                    maxFrequency = duration;
                }
            } else {
                maxFrequency = 0;
            }

            console.log(maxFrequency);

            document.getElementById('freq_time').setAttribute('max', maxFrequency);
        },
        goToStep(step) {
            this.step = step;
        },
    };
}

function validateStep(step) {
    const fields = document.querySelectorAll(`[x-ref="${step}"] input[required]`);

    for (let i = 0; i < fields.length; i++) {
        if (!fields[i].value) {
        return false;
        }
    }

    return true;
}
