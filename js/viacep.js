const address = document.querySelectorAll('.address')
const cep = document.querySelector('#cep')
const error = document.querySelector('#cep ~ .invalid-feedback')
const spinner = document.querySelector('.spinner')
const send = document.querySelector('.send')

cep.addEventListener('blur', async () => {
    if (cep.value.length >= 9) {
        spinner.classList.remove('d-none')
        cep.classList.remove('is-invalid')
        setDisabled(true)
        const data = await fetchCep(cep.value)
        if (!data) return
        spinner.classList.add('d-none')
        setDisabled(false)
        autocomplete(data)
    }
})

const fetchCep = async (value) => {
    const url = `https://viacep.com.br/ws/${value}/json/`
    try {
        const res = await fetch(url)
        const dataRes = await res.json()
        return dataRes
    } catch (error) {
        cep.classList.add('is-invalid')
        spinner.classList.add('d-none')
        return null
    }
}

const autocomplete = (data) => {
    if (data.erro) {
        cep.classList.add('is-invalid')
        address.forEach(item => {
            item.value = ''
        })
        return
    }

    address.forEach(item => {
        item.value = data[item.id]
    })
}

const setDisabled = (isDisable) => {
    if (isDisable) {
        address.forEach(input => input.setAttribute('disabled', 'true'))
        send.setAttribute('disabled', 'true')
        return
    }

    address.forEach(input => input.removeAttribute('disabled'))
    send.removeAttribute('disabled', 'true')
}