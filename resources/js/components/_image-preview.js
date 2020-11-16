//Image preview
const imgContainer = document.querySelectorAll('.image-upload')

imgContainer.forEach(function (img) {

    //Allows us to set preview image serverside
    if (img.hasAttribute('data-image')) {
        let parent = img.closest('.image-upload')
        //Hide upload button, (shows on hover)
        parent.classList.add('hidden')

        parent.setAttribute('style', `background-image: url(${img.dataset.image});`)
    }

    //Eventlistener for previewing imag
    img.querySelector('input').addEventListener('change', function (event) {
        //Create file reader
        let reader = new FileReader()

        //Input file
        let file = event.target.files[0]

        let parent = event.target.closest('.image-upload')

        //Register eventlistener for reader
        //This event will be called once reader.readAsDataUrl has finished
        reader.addEventListener(
            'load',
            function () {
                //Hide upload button, (shows on hover)
                parent.classList.add('hidden')

                //Set uploaded file as background on
                parent.setAttribute('style', `background-image: url(${reader.result});`)
            }, false)

        if (file) {
            reader.readAsDataURL(file)
        }
    })
})
