
console.log('работает первый файл JS');
function fun1() {
  var down = document.getElementById('resulttwo');
  var chbox;
  chbox = document.getElementById('checkingsamewell');
  if (chbox.checked) {
    document.getElementById('samewellblock').style.display = 'block';
  } else {
    document.getElementById('samewellblock').style.display = 'none';
  }
  down.scrollIntoView({ behavior: 'smooth' });
}

// function change(i) {
//   console.log('Работает функция по смене кнопки');
//   if (i.value == '?') {
//     i.innerHTML = 'X';
//   } else {
//     i.innerHTML = '?';
//   }
// }
let answer = document.getElementsByClassName('questionanswer')[0];
let question = document.getElementsByClassName('questionclick')[0];
question.onclick = function () {

  console.log('Работает функция по смене кнопки');
  console.log((question.textContent));
  if (question.textContent === '?') {
    question.innerHTML = '&#10006;';
    answer.style.display = 'flex';
  } else {
    question.innerHTML = '?';
    answer.style.display = 'none';
  }
};
