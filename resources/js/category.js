const categories = document.querySelectorAll(`.fr-category`)

// funzione effetto translate al passaggio dell'utente



let slider = () => {
    for (let i = 0; i < categories.length; i++) {
      let windowheight = window.innerHeight
      let revalTop = categories[i].getBoundingClientRect().top
      let revalPoint = 200
      if (revalTop < windowheight - revalPoint && i % 2 === 0) {
        categories[i].classList.add(`slide`)
        categories[i].classList.remove(`opacity-0`)
  
      }
      if (revalTop < windowheight - revalPoint && i % 2 !== 0) {
        categories[i].classList.add(`slideverse`)
        categories[i].classList.remove(`opacity-0`)
  
      }
    }
}


// EXECUTION

// funzione per fare effetto translate delle cards
document.addEventListener(`scroll`, slider)