//Like posts with fetch
const like = document.querySelectorAll('.like')
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

like.forEach(button => {
    button.addEventListener('click', () => {

        //Update counter
        const counter = button.querySelector('.likes')

        if (button.classList.contains('liked')) {
            counter.innerHTML = parseInt(counter.innerHTML) - 1
        } else {
            counter.innerHTML = parseInt(counter.innerHTML) + 1
        }

        button.classList.toggle('liked')

        const path = button.dataset.path

        fetch(path, {
            headers: {
                'Content-Type': 'application/json',
            },
            method: 'post',
            credentials: 'same-origin',
            body: JSON.stringify({
                '_token': csrf
            })
        })
    })
})
