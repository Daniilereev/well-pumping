console.log('работает файл JS по открытию теории');

function opentheory(i) {
  console.log('Пошло октрытие/закрытие теории ' + (Number(i)+1));
  let theory = document.getElementsByClassName('theory__text')[i];
  let cursor = document.getElementsByClassName('theory__button')[i];
  let computedStyle = window.getComputedStyle(theory);
  if (computedStyle.display === 'none') {
    theory.style.display ='flex';
    cursor.textContent = '▲'
    console.log('показываем');
  } else {
    theory.style.display = 'none'
    cursor.textContent = '▼'
    console.log('Закрываем');
  }

}
