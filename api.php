<script>
    const address = document.querySelectorAll('.address')
    const cep = document.querySelector('#cep')
    // const myModal = new bootstrap.Modal('#loading-modal', {
    //     keyboard: false
    // })

    cep.addEventListener('blur', async () => {
        const url = `https://viacep.com.br/ws/${cep.value}/json/`
        const res = await fetch(url)
        const dataRes = await res.json()
        autocomplete(dataRes)
    })

    const autocomplete = (data) => {
        if (data.erro) {
            console.error('erro')
            return
        }

        address.forEach(item => {
            item.value = data[item.id]
        })
    }
</script>