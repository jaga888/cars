let choice = document.querySelectorAll('.filter-title');
choice.forEach((el) => {
    el.addEventListener('click', () => {
        el.classList.toggle('opened');
    })
})

let checkbox = document.querySelectorAll('.checkbox');
checkbox.forEach((el) => {
   el.onchange = function () {
        el.closest('.checkbox-div').classList.toggle('unactive');
    }
})

let car5 = document.querySelectorAll('.car');
car5.forEach((el) => {

})

