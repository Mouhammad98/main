
function setErrorMsgFor (input , massage){
const formControl = input.parentElement;
const small = formControl.querySelector('small');

small.innerText = massage;

formControl.className = 'form-control error';

}

function setErrorFor(input) {
const formControl = input.parentElement;
const small = formControl.querySelector('small');

small.innerText = '*This elmant cannot be blank';

formControl.className = 'form-control error';
}

function setSuccessFor(input) {
const formControl = input.parentElement;
const small = formControl.querySelector('small');

small.innerText = 'Avaliabule';

formControl.className = 'form-control success';
}


function checkiFonlyLetter(input) {
  return /^[a-zA-Z ]+$/.test(input);
}

function checkIfLettersAndNumbers(input) {
  return /^[a-zA-Z0-9]+$/.test(input);
}

function checkIfEmpty(input,opt){
    const inputValue = input.value.trim();

    if(inputValue === '') {
        setErrorFor(input)
      }
    else if ( opt==1 && !checkiFonlyLetter(inputValue)) {  
        setErrorMsgFor(input,"*Letters only here");
    }
    else if ( opt==2 && !checkIfLettersAndNumbers(inputValue)) {  
      setErrorMsgFor(input,"*Letters and numbers only");}
    else {
        setSuccessFor(input);
    }
}

