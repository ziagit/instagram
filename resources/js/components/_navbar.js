//Navbar burger
const toggle = document.querySelector('.navbar-burger')

toggle.addEventListener('click', event => {
    let target = document.querySelector(toggle.dataset.target)

    toggle.classList.toggle('is-active')
    target.classList.toggle('is-active')
})
